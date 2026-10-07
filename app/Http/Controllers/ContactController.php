<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class ContactController extends Controller
{
    public function show(Request $request): View
    {
        return view('contact', [
            'contactEmail' => config('contact.email'),
            'contactPhone' => config('contact.phone'),
            'contactHours' => config('contact.hours'),
            'tools' => require app_path('Support/tool_slugs.php'),
            'selectedCategory' => old('category', $request->query('category', 'general')),
            'selectedTool' => old('tool_slug', $request->query('tool')),
            'subject' => old('subject', $request->query('subject', '')),
            'name' => old('name', $request->user()?->name),
            'email' => old('email', $request->user()?->email),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        // Honeypot fields quietly discard simple bots without revealing the check.
        if ($request->filled('website')) {
            return redirect()->route('contact.show')->with('contact_submitted', true);
        }

        $emailConsentRules = $request->user() ? ['nullable', 'accepted'] : ['required', 'accepted'];
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'subject' => ['required', 'string', 'max:180'],
            'category' => ['required', 'in:general,tool,account,privacy,feedback,other'],
            'tool_slug' => ['nullable', 'required_if:category,tool', 'string', Rule::in(array_values(require app_path('Support/tool_slugs.php')))],
            'message' => ['required', 'string', 'min:10', 'max:12000'],
            'email_updates' => $emailConsentRules,
            'website' => ['nullable', 'prohibited'],
        ]);

        $data['name'] = trim($data['name']);
        $data['email'] = Str::lower(trim($data['email']));
        $data['subject'] = trim($data['subject']);
        $data['message'] = trim($data['message']);
        $data['email_updates'] = $request->boolean('email_updates');
        if ($data['category'] !== 'tool') {
            $data['tool_slug'] = null;
        }
        $data['user_id'] = $request->user()?->id;
        $data['status'] = 'new';

        $message = ContactMessage::create($data);

        if (filled(config('contact.email')) && ! in_array(config('mail.default'), ['log', 'array'], true)) {
            try {
                Mail::send('emails.admin-contact-notice', [
                    'contactMessage' => $message,
                    'inboxUrl' => route('admin.contact.show', $message),
                ], fn ($mail) => $mail->to(config('contact.email'))->subject('New support message: '.$message->subject));
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        return redirect()->route('contact.show')->with('contact_submitted', true)->with('email_updates_enabled', $data['email_updates']);
    }
}
