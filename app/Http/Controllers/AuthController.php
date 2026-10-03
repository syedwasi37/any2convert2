<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Support\Totp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Throwable;

class AuthController extends Controller
{
    public function show(Request $request, string $mode = 'login'): View
    {
        return view('auth', [
            'mode' => $mode === 'register' ? 'register' : 'login',
            'googleEnabled' => filled(config('services.google.client_id')) && filled(config('services.google.client_secret')),
        ]);
    }

    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
            'password' => ['required', 'string'],
        ]);
        $credentials['email'] = Str::lower(trim($credentials['email']));

        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()->withErrors(['email' => 'Those details don’t match an account. Please try again.'])->onlyInput('email');
        }

        return $this->finishAuthentication(Auth::user(), $request);
    }

    public function register(Request $request): RedirectResponse
    {
        $request->merge(['email' => Str::lower(trim((string) $request->input('email')))]);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', 'min:8'],
        ]);
        $data['name'] = trim($data['name']);
        $data['email'] = Str::lower(trim($data['email']));

        $user = User::create($data);
        return $this->finishAuthentication($user, $request);
    }

    public function sendOtp(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
            'name' => ['nullable', 'string', 'max:120'],
            'mode' => ['nullable', 'in:login,register'],
        ]);
        $email = Str::lower(trim($data['email']));
        $name = trim($data['name'] ?? '');
        $mode = $data['mode'] ?? 'login';

        // Log/array mailers accept messages without delivering them. Avoid
        // telling production users an OTP was sent when SMTP is not configured.
        if (app()->environment('production') && in_array(config('mail.default'), ['log', 'array'], true)) {
            return back()->withErrors([
                'email' => 'Email delivery is not configured yet. Please contact the site administrator.',
            ])->withInput();
        }

        $rateKey = 'auth-otp-send:'.hash('sha256', $email.'|'.$request->ip());

        if (RateLimiter::tooManyAttempts($rateKey, 3)) {
            return back()->withErrors(['email' => 'Too many codes requested. Please wait a few minutes and try again.'])
                ->withInput()->with('otp_sent_to', $email)->with('otp_name', $name)->with('otp_mode', $mode);
        }
        RateLimiter::hit($rateKey, 600);

        $code = (string) random_int(100000, 999999);
        $cacheKey = 'auth-otp:'.hash('sha256', $email);

        try {
            Mail::raw(
                "Your Any2Convert sign-in code is {$code}. It expires in 10 minutes. If you didn’t request this, you can ignore this email.",
                function ($message) use ($email): void {
                    $message->to($email)->subject('Your Any2Convert sign-in code');
                }
            );
            Cache::put($cacheKey, Hash::make($code), now()->addMinutes(10));
        } catch (Throwable $exception) {
            report($exception);

            return back()->withErrors(['email' => 'We couldn’t send your code just now. Please try again shortly.'])->withInput();
        }

        return redirect()->route($mode === 'register' ? 'register' : 'login')
            ->with('otp_sent_to', $email)
            ->with('otp_name', $name)
            ->with('otp_mode', $mode)
            ->with('status', 'If this email can receive sign-in codes, one is on its way. It is valid for 10 minutes.');
    }

    public function verifyOtp(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'email' => ['required', 'email:rfc', 'max:255'],
            'code' => ['required', 'digits:6'],
            'name' => ['nullable', 'string', 'max:120'],
            'mode' => ['nullable', 'in:login,register'],
        ]);
        $email = Str::lower(trim($data['email']));
        $cacheKey = 'auth-otp:'.hash('sha256', $email);
        $rateKey = 'auth-otp-verify:'.hash('sha256', $email.'|'.$request->ip());
        $route = ($data['mode'] ?? 'login') === 'register' ? 'register' : 'login';

        if (RateLimiter::tooManyAttempts($rateKey, 5)) {
            return back()->withErrors(['code' => 'Too many incorrect attempts. Request a new code and try again.'])
                ->withInput()->with('otp_sent_to', $email)->with('otp_name', $data['name'] ?? '')->with('otp_mode', $route);
        }

        $hashedCode = Cache::get($cacheKey);
        if (! is_string($hashedCode) || ! Hash::check($data['code'], $hashedCode)) {
            RateLimiter::hit($rateKey, 600);

            return back()->withErrors(['code' => 'That code is incorrect or has expired. Request a new one to continue.'])
                ->withInput()->with('otp_sent_to', $email)->with('otp_name', $data['name'] ?? '')->with('otp_mode', $route);
        }

        $user = User::where('email', $email)->first();
        if (! $user && blank(trim($data['name'] ?? ''))) {
            return redirect()->route($route)->with('otp_sent_to', $email)
                ->with('otp_name', '')
                ->with('otp_mode', $route)
                ->withErrors(['name' => 'Add your name to finish creating your account.']);
        }

        Cache::forget($cacheKey);
        RateLimiter::clear($rateKey);

        if (! $user) {
            $user = User::create([
                'name' => trim($data['name']),
                'email' => $email,
                'password' => Str::random(48),
                'email_verified_at' => now(),
            ]);
        } elseif (! $user->email_verified_at) {
            $user->forceFill(['email_verified_at' => now()])->save();
        }

        return $this->finishAuthentication($user, $request);
    }

    public function googleRedirect(Request $request): RedirectResponse
    {
        $clientId = config('services.google.client_id');
        if (blank($clientId) || blank(config('services.google.client_secret'))) {
            return redirect()->route('login')->withErrors([
                'google' => 'Google sign-in is not configured yet. Add the OAuth values listed in the setup notes to your environment.',
            ]);
        }

        $state = Str::random(48);
        $verifier = Str::random(96);
        $challenge = rtrim(strtr(base64_encode(hash('sha256', $verifier, true)), '+/', '-_'), '=');
        $redirectUri = config('services.google.redirect_uri') ?: route('auth.google.callback');
        $request->session()->put('google_oauth_state', $state);
        $request->session()->put('google_oauth_verifier', $verifier);

        $query = http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => $redirectUri,
            'response_type' => 'code',
            'scope' => 'openid email profile',
            'state' => $state,
            'code_challenge' => $challenge,
            'code_challenge_method' => 'S256',
        ]);

        return redirect('https://accounts.google.com/o/oauth2/v2/auth?'.$query);
    }

    public function googleCallback(Request $request): RedirectResponse
    {
        $expectedState = (string) $request->session()->pull('google_oauth_state', '');
        $verifier = (string) $request->session()->pull('google_oauth_verifier', '');

        if ($request->filled('error') || blank($expectedState) || blank($verifier)
            || ! hash_equals($expectedState, (string) $request->query('state', ''))) {
            return redirect()->route('login')->withErrors(['google' => 'Google sign-in was cancelled or could not be verified. Please try again.']);
        }

        try {
            $tokenResponse = Http::asForm()->acceptJson()->timeout(10)->post('https://oauth2.googleapis.com/token', [
                'code' => $request->query('code'),
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'redirect_uri' => config('services.google.redirect_uri') ?: route('auth.google.callback'),
                'grant_type' => 'authorization_code',
                'code_verifier' => $verifier,
            ])->throw()->json();

            $profile = Http::withToken($tokenResponse['access_token'] ?? '')
                ->acceptJson()->timeout(10)
                ->get('https://openidconnect.googleapis.com/v1/userinfo')->throw()->json();

            if (empty($profile['sub']) || empty($profile['email']) || ! filter_var($profile['email'], FILTER_VALIDATE_EMAIL)
                || ! filter_var($profile['email_verified'] ?? false, FILTER_VALIDATE_BOOLEAN)) {
                return redirect()->route('login')->withErrors(['google' => 'Google did not provide a verified email address. Please use email sign-in instead.']);
            }

            $email = Str::lower(trim($profile['email']));
            $user = User::where('google_id', $profile['sub'])->first();

            if (! $user) {
                $user = User::where('email', $email)->first();
                if ($user && filled($user->google_id) && ! hash_equals((string) $user->google_id, (string) $profile['sub'])) {
                    return redirect()->route('login')->withErrors(['google' => 'This email is linked to a different Google account. Sign in with email to continue.']);
                }
            }

            if (! $user) {
                $user = User::create([
                    'name' => trim((string) ($profile['name'] ?? Str::before($email, '@'))),
                    'email' => $email,
                    'password' => Str::random(48),
                    'email_verified_at' => now(),
                    'google_id' => $profile['sub'],
                ]);
            } else {
                $user->forceFill([
                    'google_id' => $profile['sub'],
                    'email_verified_at' => $user->email_verified_at ?? now(),
                ])->save();
            }

            return $this->finishAuthentication($user, $request);
        } catch (Throwable $exception) {
            report($exception);

            return redirect()->route('login')->withErrors(['google' => 'Google sign-in could not be completed. Please try again.']);
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function showTwoFactorChallenge(Request $request): View|RedirectResponse
    {
        $user = $this->pendingTwoFactorUser($request);
        if (! $user) {
            return redirect()->route('login')->withErrors(['google' => 'Your sign-in session expired. Please try again.']);
        }

        return view('auth.two-factor', ['email' => $user->email]);
    }

    public function verifyTwoFactorChallenge(Request $request): RedirectResponse
    {
        $data = $request->validate(['code' => ['required', 'string', 'max:32']]);
        $user = $this->pendingTwoFactorUser($request);
        if (! $user) {
            return redirect()->route('login')->withErrors(['google' => 'Your sign-in session expired. Please try again.']);
        }

        $code = trim($data['code']);
        $valid = Totp::verify((string) $user->two_factor_secret, $code);
        if (! $valid) {
            $normalized = strtoupper(str_replace(['-', ' '], '', $code));
            $recoveryCodes = $user->two_factor_recovery_codes ?? [];
            foreach ($recoveryCodes as $index => $hash) {
                if (Hash::check($normalized, $hash)) {
                    unset($recoveryCodes[$index]);
                    $user->forceFill(['two_factor_recovery_codes' => array_values($recoveryCodes)])->save();
                    $valid = true;
                    break;
                }
            }
        }

        if (! $valid) {
            return back()->withErrors(['code' => 'That code is not valid. Try the current code in your authenticator app.']);
        }

        $request->session()->forget(['pending_two_factor_user_id', 'pending_two_factor_expires_at']);
        if (! Auth::check() || (string) Auth::id() !== (string) $user->getKey()) {
            Auth::login($user);
        }
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    private function finishAuthentication(User $user, Request $request): RedirectResponse
    {
        if ($user->hasTwoFactorEnabled()) {
            Auth::logout();
            $request->session()->regenerate();
            $request->session()->put([
                'pending_two_factor_user_id' => $user->getKey(),
                'pending_two_factor_expires_at' => now()->addMinutes(10)->timestamp,
            ]);

            return redirect()->route('auth.two-factor.challenge');
        }

        if (! Auth::check() || (string) Auth::id() !== (string) $user->getKey()) {
            Auth::login($user);
        }
        $request->session()->regenerate();

        return redirect()->intended(route('home'));
    }

    private function pendingTwoFactorUser(Request $request): ?User
    {
        $expiresAt = (int) $request->session()->get('pending_two_factor_expires_at', 0);
        if ($expiresAt < now()->timestamp) {
            $request->session()->forget(['pending_two_factor_user_id', 'pending_two_factor_expires_at']);

            return null;
        }

        $user = User::find($request->session()->get('pending_two_factor_user_id'));
        if (! $user?->hasTwoFactorEnabled()) {
            $request->session()->forget(['pending_two_factor_user_id', 'pending_two_factor_expires_at']);

            return null;
        }

        return $user;
    }
}
