<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ContactMessage;
use App\Support\Totp;
use App\Support\CountryCatalog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Throwable;

class ProfileController extends Controller
{
    public function show(Request $request): View
    {
        $user = $request->user();
        $pendingSecret = $request->session()->get('two_factor_setup_secret');
        $phoneParts = CountryCatalog::splitPhone($user->phone, $user->country_code, $user->phone_country_code);

        return view('account.profile', [
            'user' => $user,
            'countries' => CountryCatalog::all(),
            'selectedCountry' => old('country_code', $phoneParts['country_code']),
            'phoneLocal' => old('phone', $phoneParts['local_number']),
            'setupSecret' => $pendingSecret,
            'setupUri' => $pendingSecret ? Totp::provisioningUri($user->email, $pendingSecret) : null,
            'recoveryCodes' => $request->session()->get('new_recovery_codes', []),
        ]);
    }

    public function supportMessages(Request $request): View
    {
        $messages = ContactMessage::query()
            ->where('user_id', $request->user()->getKey())
            ->with('replies')
            ->latest()
            ->paginate(10);

        return view('account.messages', compact('messages'));
    }

    public function updateProfile(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'country_code' => ['nullable', 'string', 'size:2', 'required_with:phone', Rule::in(array_column(CountryCatalog::all(), 'code'))],
            'phone' => ['nullable', 'string', 'max:32', 'regex:/^(?=(?:\D*\d){7,15}\D*$)(?![\s().-]*0+[\s().-]*$)[0-9\s().-]+$/'],
        ]);
        $phone = CountryCatalog::normalizePhone($data['phone'] ?? null, $data['country_code'] ?? null);

        $request->user()->forceFill([
            'name' => trim($data['name']),
            'phone' => $phone['phone'],
            'country_code' => $phone['country_code'],
            'country_name' => $phone['country_name'],
            'phone_country_code' => $phone['phone_country_code'],
        ])->save();

        return back()->with('status', 'Your profile details are updated.');
    }

    public function sendEmailChangeCode(Request $request): RedirectResponse
    {
        $user = $request->user();
        $rateKey = 'account-email-change-send:'.$user->getKey();
        if (RateLimiter::tooManyAttempts($rateKey, 3)) {
            return back()->withErrors(['email_change' => 'Too many codes requested. Wait a few minutes and try again.']);
        }
        if (app()->environment('production') && in_array(config('mail.default'), ['log', 'array'], true)) {
            return back()->withErrors(['email_change' => 'Email delivery is not configured. Please contact support.']);
        }

        $code = (string) random_int(100000, 999999);
        try {
            Mail::raw(
                "Your Any2Convert email-change approval code is {$code}. It expires in 10 minutes. If you didn’t request this, you can ignore this email.",
                fn ($message) => $message->to($user->email)->subject('Approve your email address change')
            );
            Cache::put($this->emailChangeCurrentKey($user), [
                'email' => $user->email,
                'code_hash' => Hash::make($code),
            ], now()->addMinutes(10));
            Cache::forget($this->emailChangePendingKey($user));
            $request->session()->put('email_change_current_code_sent', true);
            $request->session()->forget('email_change_pending_new_email');
            RateLimiter::hit($rateKey, 600);
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors(['email_change' => 'We could not send the code to your current email. Please try again shortly.']);
        }

        return back()->with('status', 'A confirmation code was sent to your current email address.');
    }

    public function updateEmail(Request $request): RedirectResponse
    {
        $user = $request->user();
        $request->merge(['new_email' => Str::lower(trim((string) $request->input('new_email')))]);
        $data = $request->validate([
            'new_email' => ['required', 'email:rfc', 'max:255', Rule::unique('users', 'email')->ignore($user->getKey())],
            'current_email_code' => ['required', 'digits:6'],
        ]);
        $rateKey = 'account-email-change-verify:'.$user->getKey();
        if (RateLimiter::tooManyAttempts($rateKey, 5)) {
            return back()->withErrors(['current_email_code' => 'Too many attempts. Request a new code and try again.'])->withInput();
        }

        $currentChallenge = Cache::get($this->emailChangeCurrentKey($user));
        if (! is_array($currentChallenge)
            || ! hash_equals((string) ($currentChallenge['email'] ?? ''), (string) $user->email)
            || ! Hash::check($data['current_email_code'], (string) ($currentChallenge['code_hash'] ?? ''))) {
            RateLimiter::hit($rateKey, 600);

            return back()->withErrors(['current_email_code' => 'That code is incorrect or expired. Request a new code to your current email.'])->withInput();
        }

        if (Str::lower($data['new_email']) === Str::lower($user->email)) {
            return back()->withErrors(['new_email' => 'Enter an email address different from your current one.'])->withInput();
        }
        if (app()->environment('production') && in_array(config('mail.default'), ['log', 'array'], true)) {
            return back()->withErrors(['new_email' => 'Email delivery is not configured. Please contact support.'])->withInput();
        }

        $newCode = (string) random_int(100000, 999999);
        try {
            Mail::raw(
                "Your Any2Convert email confirmation code is {$newCode}. It expires in 10 minutes. If you didn’t request this, you can ignore this email.",
                fn ($message) => $message->to($data['new_email'])->subject('Confirm your new Any2Convert email')
            );
            Cache::put($this->emailChangePendingKey($user), [
                'email' => $data['new_email'],
                'code_hash' => Hash::make($newCode),
            ], now()->addMinutes(10));
            Cache::forget($this->emailChangeCurrentKey($user));
            RateLimiter::clear($rateKey);
            $request->session()->forget('email_change_current_code_sent');
            $request->session()->put('email_change_pending_new_email', $data['new_email']);
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors(['new_email' => 'We could not send a confirmation code to that address. Please check it and try again.'])->withInput();
        }

        return back()->with('status', 'Your current email was confirmed. We sent a final code to the new address.');
    }

    public function confirmEmailChange(Request $request): RedirectResponse
    {
        $data = $request->validate(['new_email_code' => ['required', 'digits:6']]);
        $user = $request->user();
        $rateKey = 'account-email-change-confirm:'.$user->getKey();
        if (RateLimiter::tooManyAttempts($rateKey, 5)) {
            return back()->withErrors(['new_email_code' => 'Too many attempts. Request a fresh email-change code and try again.']);
        }

        $pending = Cache::get($this->emailChangePendingKey($user));
        if (! is_array($pending) || ! filter_var($pending['email'] ?? null, FILTER_VALIDATE_EMAIL)
            || ! Hash::check($data['new_email_code'], (string) ($pending['code_hash'] ?? ''))) {
            RateLimiter::hit($rateKey, 600);

            return back()->withErrors(['new_email_code' => 'That code is incorrect or expired. Start the email-change process again.']);
        }

        $newEmail = Str::lower((string) $pending['email']);
        if (User::where('email', $newEmail)->where('id', '<>', $user->getKey())->exists()) {
            Cache::forget($this->emailChangePendingKey($user));
            $request->session()->forget('email_change_pending_new_email');

            return back()->withErrors(['new_email_code' => 'That email address is already connected to another account. Start again with a different address.']);
        }

        $oldEmail = $user->email;
        $user->forceFill(['email' => $newEmail, 'email_verified_at' => now()])->save();
        Cache::forget($this->emailChangePendingKey($user));
        RateLimiter::clear($rateKey);
        $request->session()->forget(['email_change_current_code_sent', 'email_change_pending_new_email']);

        try {
            Mail::raw(
                "The email address on your Any2Convert account was changed to {$newEmail}. If you did not make this change, reset your password and contact support.",
                fn ($message) => $message->to($oldEmail)->subject('Your Any2Convert email was changed')
            );
        } catch (Throwable $exception) {
            report($exception);
        }

        return back()->with('status', 'Your account email address has been changed successfully.');
    }

    private function emailChangeCurrentKey(User $user): string
    {
        return 'account-email-change-current:'.$user->getKey();
    }

    private function emailChangePendingKey(User $user): string
    {
        return 'account-email-change-pending:'.$user->getKey();
    }

    public function sendPasswordCode(Request $request): RedirectResponse
    {
        $user = $request->user();
        $rateKey = 'account-password-code:'.$user->getKey();
        if (RateLimiter::tooManyAttempts($rateKey, 3)) {
            return back()->withErrors(['password_code' => 'Too many codes requested. Wait a few minutes and try again.']);
        }

        if (app()->environment('production') && in_array(config('mail.default'), ['log', 'array'], true)) {
            return back()->withErrors(['password_code' => 'Email delivery is not configured. Please contact support.']);
        }

        $code = (string) random_int(100000, 999999);
        try {
            Mail::raw(
                "Your Any2Convert password update code is {$code}. It expires in 10 minutes. If you didn’t request this, you can ignore this email.",
                fn ($message) => $message->to($user->email)->subject('Confirm your password update')
            );
            Cache::put('account-password-code:'.$user->getKey(), Hash::make($code), now()->addMinutes(10));
            RateLimiter::hit($rateKey, 600);
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors(['password_code' => 'We could not send the confirmation code. Please try again shortly.']);
        }

        return back()->with('password_code_sent', true)->with('status', 'A confirmation code was sent to your account email.');
    }

    public function updatePassword(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'password_code' => ['required', 'digits:6'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);
        $cacheKey = 'account-password-code:'.$request->user()->getKey();
        $hash = Cache::get($cacheKey);

        if (! is_string($hash) || ! Hash::check($data['password_code'], $hash)) {
            return back()->withErrors(['password_code' => 'That code is incorrect or expired. Request a new one.']);
        }

        $request->user()->forceFill(['password' => $data['password']])->save();
        Cache::forget($cacheKey);

        return back()->with('status', 'Your password has been updated.');
    }

    public function startTwoFactorSetup(Request $request): RedirectResponse
    {
        if ($request->user()->hasTwoFactorEnabled()) {
            return back()->withErrors(['two_factor' => 'Two-step verification is already enabled.']);
        }

        $request->session()->put('two_factor_setup_secret', Totp::secret());

        return back()->with('status', 'Scan the setup key with an authenticator app, then enter its current six-digit code.');
    }

    public function confirmTwoFactorSetup(Request $request): RedirectResponse
    {
        $data = $request->validate(['code' => ['required', 'digits:6']]);
        $secret = $request->session()->get('two_factor_setup_secret');

        if (! is_string($secret) || ! Totp::verify($secret, $data['code'])) {
            return back()->withErrors(['two_factor_code' => 'That code did not match. Check your authenticator and try again.']);
        }

        $recoveryCodes = [];
        $hashedCodes = [];
        for ($index = 0; $index < 8; $index++) {
            $raw = strtoupper(bin2hex(random_bytes(5)));
            $recoveryCodes[] = implode('-', str_split($raw, 5));
            $hashedCodes[] = Hash::make($raw);
        }

        $request->user()->forceFill([
            'two_factor_secret' => $secret,
            'two_factor_recovery_codes' => $hashedCodes,
            'two_factor_confirmed_at' => now(),
        ])->save();
        $request->session()->forget('two_factor_setup_secret');

        return back()->with('new_recovery_codes', $recoveryCodes)->with('status', 'Two-step verification is enabled. Save your recovery codes somewhere safe.');
    }

    public function disableTwoFactor(Request $request): RedirectResponse
    {
        $data = $request->validate(['code' => ['required', 'string', 'max:32']]);
        $user = $request->user();
        $code = trim($data['code']);
        $valid = $user->hasTwoFactorEnabled() && Totp::verify((string) $user->two_factor_secret, $code);

        if (! $valid && $user->hasTwoFactorEnabled()) {
            $normalized = strtoupper(str_replace(['-', ' '], '', $code));
            $codes = $user->two_factor_recovery_codes ?? [];
            foreach ($codes as $index => $hash) {
                if (Hash::check($normalized, $hash)) {
                    unset($codes[$index]);
                    $user->forceFill(['two_factor_recovery_codes' => array_values($codes)])->save();
                    $valid = true;
                    break;
                }
            }
        }

        if (! $valid) {
            return back()->withErrors(['disable_code' => 'Enter a valid authenticator code or unused recovery code.']);
        }

        $user->forceFill([
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'two_factor_confirmed_at' => null,
        ])->save();

        return back()->with('status', 'Two-step verification is now disabled.');
    }
}
