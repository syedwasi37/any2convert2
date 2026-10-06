<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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

        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'subject' => ['required', 'string', 'max:180'],
            'category' => ['required', 'in:general,tool,account,privacy,feedback,other'],
            'message' => ['required', 'string', 'min:10', 'max:12000'],
            'website' => ['nullable', 'prohibited'],
        ]);

        $data['name'] = trim($data['name']);
        $data['email'] = Str::lower(trim($data['email']));
        $data['subject'] = trim($data['subject']);
        $data['message'] = trim($data['message']);
        $data['user_id'] = $request->user()?->id;
        $data['status'] = 'new';

        $message = ContactMessage::create($data);

        if (filled(config('contact.email')) && ! in_array(config('mail.default'), ['log', 'array'], true)) {
            try {
                Mail::raw(
                    "A new website contact message is waiting in the admin inbox.\n\nFrom: {$message->name} <{$message->email}>\nSubject: {$message->subject}\n\nOpen: ".route('admin.contact.show', $message),
                    fn ($mail) => $mail->to(config('contact.email'))->subject('New Any2Convert contact message')
                );
            } catch (Throwable $exception) {
                report($exception);
            }
        }

        return redirect()->route('contact.show')->with('contact_submitted', true);
    }
}
