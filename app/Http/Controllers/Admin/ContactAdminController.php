<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\ContactMessageReply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
use Throwable;

class ContactAdminController extends Controller
{
    private const STATUSES = ['new', 'in_progress', 'replied', 'closed', 'spam'];

    public function index(Request $request): View
    {
        $status = $request->query('status');
        abort_if($status && ! in_array($status, self::STATUSES, true), 404);

        $messages = ContactMessage::query()
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($request->filled('q'), function ($query) use ($request): void {
                $term = '%'.str_replace(['%', '_'], ['\\%', '\\_'], trim((string) $request->query('q'))).'%';
                $query->where(function ($nested) use ($term): void {
                    $nested->where('name', 'like', $term)
                        ->orWhere('email', 'like', $term)
                        ->orWhere('subject', 'like', $term)
                        ->orWhere('message', 'like', $term);
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $counts = ContactMessage::query()
            ->selectRaw('status, count(*) as aggregate')
            ->groupBy('status')
            ->pluck('aggregate', 'status');

        return view('admin.contact.index', compact('messages', 'status', 'counts'));
    }

    public function show(ContactMessage $contactMessage): View
    {
        $contactMessage->load(['replies.author', 'user']);

        return view('admin.contact.show', ['message' => $contactMessage, 'statuses' => self::STATUSES]);
    }

    public function update(Request $request, ContactMessage $contactMessage): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email:rfc', 'max:255'],
            'subject' => ['required', 'string', 'max:180'],
            'category' => ['required', 'in:general,tool,account,privacy,feedback,other'],
            'status' => ['required', 'in:'.implode(',', self::STATUSES)],
            'internal_note' => ['nullable', 'string', 'max:12000'],
        ]);

        $contactMessage->update($data);

        return back()->with('status', 'Message details updated.');
    }

    public function reply(Request $request, ContactMessage $contactMessage): RedirectResponse
    {
        $data = $request->validate(['body' => ['required', 'string', 'min:2', 'max:12000']]);
        $reply = $contactMessage->replies()->create([
            'user_id' => $request->user()->id,
            'body' => trim($data['body']),
            'delivery_status' => 'pending',
        ]);

        return $this->deliverReply($contactMessage, $reply);
    }

    public function resend(ContactMessage $contactMessage, ContactMessageReply $reply): RedirectResponse
    {
        abort_unless($reply->contact_message_id === $contactMessage->id, 404);
        abort_if($reply->delivery_status === 'sent', 409, 'This reply has already been sent.');

        return $this->deliverReply($contactMessage, $reply);
    }

    public function destroy(ContactMessage $contactMessage): RedirectResponse
    {
        $contactMessage->delete();

        return redirect()->route('admin.contact.index')->with('status', 'Message deleted.');
    }

    private function deliverReply(ContactMessage $contactMessage, ContactMessageReply $reply): RedirectResponse
    {
        // Log and array mailers intentionally do not deliver mail. Keep replies
        // pending so an administrator can resend after configuring a real mailer.
        if (in_array(config('mail.default'), ['log', 'array'], true)) {
            $reply->update(['delivery_status' => 'pending']);

            return back()->with('warning', 'Reply saved, but not sent. Configure a delivery mailer, then use Resend.');
        }

        try {
            Mail::raw($reply->body, function ($mail) use ($contactMessage): void {
                $mail->to($contactMessage->email)
                    ->subject('Re: '.$contactMessage->subject);
                if (filled(config('contact.email'))) {
                    $mail->replyTo(config('contact.email'), config('mail.from.name'));
                }
            });

            $sentAt = now();
            $reply->update(['delivery_status' => 'sent', 'sent_at' => $sentAt]);
            $contactMessage->update(['status' => 'replied', 'last_replied_at' => $sentAt]);

            return back()->with('status', 'Reply sent to '.$contactMessage->email.'.');
        } catch (Throwable $exception) {
            report($exception);
            $reply->update(['delivery_status' => 'failed']);

            return back()->with('warning', 'The reply is saved, but email delivery failed. Check your mail settings and resend it.');
        }
    }
}
