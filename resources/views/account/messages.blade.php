<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @include('partials.site-theme')
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex,nofollow">
    <title>Support messages · Any2Convert</title>
    @include('partials.tailwind-assets')
    <style>
        :root{--ink:#252923;--muted:#747b72;--line:#e7eae4;--paper:#fff;--wash:#f6f7f4;--green:#315b3d;--green-soft:#edf4eb;--copy:#434a41;--reply:#f7faf6;--control:#fff;--pill:#f1f3ef;--pill-ink:#596258}html.dark{--ink:#edf0e9;--muted:#a3ab9e;--line:#343b33;--paper:#1b201b;--wash:#111511;--green:#9cc5a0;--green-soft:#27352a;--copy:#d1d8cf;--reply:#202b21;--control:#171c17;--pill:#2a3029;--pill-ink:#c3cbc0;color-scheme:dark}*{box-sizing:border-box}body{margin:0;background:var(--wash);color:var(--ink);font:15px/1.55 Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif}.messages-wrap{width:min(900px,calc(100% - 32px));margin:38px auto 64px}.messages-heading{display:flex;align-items:flex-end;justify-content:space-between;gap:18px;margin-bottom:22px}.eyebrow{margin:0;color:var(--green);font-size:11px;font-weight:750;letter-spacing:.13em;text-transform:uppercase}.messages-heading h1{margin:5px 0;font-size:clamp(27px,4vw,36px);line-height:1.15;letter-spacing:-.04em}.muted{color:var(--muted);font-size:13px}.message-card{margin:14px 0;padding:22px;border:1px solid var(--line);border-radius:15px;background:var(--paper);box-shadow:0 6px 24px #28362606}.message-top{display:flex;justify-content:space-between;gap:12px;align-items:flex-start}.message-top h2{margin:0;font-size:17px;letter-spacing:-.025em;overflow-wrap:anywhere}.pill{display:inline-flex;padding:4px 9px;border-radius:999px;background:var(--pill);color:var(--pill-ink);font-size:11px;font-weight:750;text-transform:capitalize;white-space:nowrap}.body-copy{margin:15px 0 0;white-space:pre-wrap;overflow-wrap:anywhere;color:var(--copy);font-size:14px}.reply{margin-top:17px;padding:16px;border:1px solid var(--line);border-radius:11px;background:var(--reply)}.reply-head{display:flex;justify-content:space-between;gap:10px;align-items:center;color:var(--green);font-size:13px;font-weight:750}.reply .body-copy{margin-top:9px}.empty{padding:34px 20px;text-align:center}.button{display:inline-flex;align-items:center;justify-content:center;min-height:40px;padding:0 14px;border:1px solid var(--line);border-radius:9px;background:var(--paper);color:var(--ink);text-decoration:none;font-size:13px;font-weight:700}.button:hover{border-color:var(--green);background:var(--reply)}.pagination{margin-top:18px}.status-note{margin-bottom:16px;padding:11px 14px;border:1px solid var(--line);border-radius:9px;background:var(--green-soft);color:var(--green);font-size:13px}.messages-wrap textarea,.messages-wrap select{background:var(--control)!important;color:var(--ink)!important;border-color:var(--line)!important}.star-rating label{color:#778174}.star-rating input:checked+label,.star-rating label:hover,.star-rating label:hover~label{color:#e3ae42}@media(max-width:560px){.messages-wrap{width:calc(100% - 24px);margin-top:24px}.messages-heading{align-items:flex-start;flex-direction:column}.message-card{padding:17px}.message-top{flex-direction:column}}
    </style>
</head>
<body>
    @include('partials.site-navbar')
    <main class="messages-wrap">
        <header class="messages-heading">
            <div><p class="eyebrow">Your account</p><h1>Support messages</h1><p class="muted" style="margin:0">Questions you sent while signed in and replies from our team appear here.</p></div>
            <a class="button" href="{{ route('contact.show') }}">Send a message</a>
        </header>

        @if (session('status'))<div class="status-note" role="status">{{ session('status') }}</div>@endif

        @forelse ($messages as $message)
            <article class="message-card">
                <div class="message-top">
                    <div><h2>{{ $message->subject }}</h2><div class="muted">Sent {{ $message->created_at?->format('M j, Y · g:i a') ?? 'recently' }} · {{ ucfirst($message->category ?: 'general') }}@if($message->tool_slug) · {{ \Illuminate\Support\Str::headline($message->tool_slug) }}@endif @if(!is_null($message->user_resolved)) · You marked it {{ $message->user_resolved ? 'resolved' : 'not resolved' }}@endif</div></div>
                    <span class="pill">{{ str_replace('_', ' ', $message->status) }}</span>
                </div>
                <p class="body-copy">{{ $message->message }}</p>
                @forelse ($message->replies as $reply)
                    <section class="reply" aria-label="Reply from support">
                        <div class="reply-head"><span>{{ (int) $reply->user_id === (int) $message->user_id ? 'Your reply' : 'Any2Convert support' }}</span><time class="muted">{{ $reply->sent_at?->format('M j, Y · g:i a') ?? $reply->created_at?->format('M j, Y · g:i a') ?? '' }}</time></div>
                        <p class="body-copy">{{ $reply->body }}</p>
                        @if ((int) $reply->user_id !== (int) $message->user_id && $reply->delivery_status !== 'sent')<p class="muted" style="margin:10px 0 0">You can read this reply here. Email delivery is still pending.</p>@endif
                        @if ((int) $reply->user_id === (int) $message->user_id && $message->status !== 'closed')
                            <details style="margin-top:10px"><summary class="muted" style="cursor:pointer">Edit your reply</summary><form method="post" action="{{ route('account.messages.reply.update', [$message, $reply]) }}" style="margin-top:8px">@csrf @method('PATCH')<textarea name="body" rows="3" maxlength="12000" required style="display:block;width:100%;padding:10px;border:1px solid var(--line);border-radius:8px;background:var(--control);color:var(--ink);font:inherit">{{ $reply->body }}</textarea><button class="button" style="margin-top:8px">Save edit</button></form></details>
                            <form method="post" action="{{ route('account.messages.reply.delete', [$message, $reply]) }}" style="margin-top:7px" onsubmit="return confirm('Delete your reply?')">@csrf @method('DELETE')<button class="button" type="submit">Delete your reply</button></form>
                        @endif
                    </section>
                @empty
                    <p class="muted" style="margin:14px 0 0">Our team hasn’t replied yet. @if($message->email_updates) We’ll also email you when we respond. @else Check this page for updates; email notifications are off. @endif</p>
                @endforelse

                @if ($message->status !== 'closed')
                    <details style="margin-top:12px"><summary class="muted" style="cursor:pointer">Edit your original message</summary><form method="post" action="{{ route('account.messages.update', $message) }}" style="margin-top:8px">@csrf @method('PATCH')<input type="hidden" name="category" value="{{ $message->category }}"><input type="hidden" name="tool_slug" value="{{ $message->tool_slug }}"><label class="muted" for="subject-{{ $message->id }}">Subject</label><input id="subject-{{ $message->id }}" name="subject" value="{{ $message->subject }}" maxlength="180" required style="display:block;width:100%;padding:10px;margin:4px 0 8px;border:1px solid var(--line);border-radius:8px;background:var(--control);color:var(--ink);font:inherit"><label class="muted" for="original-{{ $message->id }}">Message</label><textarea id="original-{{ $message->id }}" name="message" rows="4" maxlength="12000" required style="display:block;width:100%;padding:10px;margin-top:4px;border:1px solid var(--line);border-radius:8px;background:var(--control);color:var(--ink);font:inherit">{{ $message->message }}</textarea><button class="button" style="margin-top:8px">Save edit</button></form></details>
                    <form method="post" action="{{ route('account.messages.delete', $message) }}" style="margin-top:8px" onsubmit="return confirm('Delete this support conversation and all its replies?')">@csrf @method('DELETE')<button class="button" type="submit">Delete conversation</button></form>
                    <form method="post" action="{{ route('account.messages.email-updates', $message) }}" style="margin-top:12px;padding-top:12px;border-top:1px solid var(--line);display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap">@csrf @method('PATCH')<label class="muted" style="display:flex;align-items:center;gap:8px"><input type="hidden" name="email_updates" value="0"><input type="checkbox" name="email_updates" value="1" @checked($message->email_updates)> Email me when support replies</label><button class="button" type="submit">Save email preference</button></form>
                    <form method="post" action="{{ route('account.messages.reply', $message) }}" style="margin-top:16px;padding-top:15px;border-top:1px solid var(--line)">
                        @csrf
                        <label class="muted" for="reply-{{ $message->id }}" style="display:block;font-weight:700;margin-bottom:6px">Reply to support</label>
                        <textarea id="reply-{{ $message->id }}" name="body" rows="4" maxlength="12000" required style="display:block;width:100%;padding:11px 12px;border:1px solid var(--line);border-radius:9px;background:#fff;color:var(--ink);font:inherit;resize:vertical" placeholder="Add details or let us know whether the issue is resolved…"></textarea>
                        <label class="muted" for="resolved-{{ $message->id }}" style="display:block;margin:10px 0 5px">Is your issue resolved?</label>
                        <select id="resolved-{{ $message->id }}" name="user_resolved" style="min-height:40px;padding:0 10px;border:1px solid var(--line);border-radius:8px;background:#fff;color:var(--ink);font:inherit"><option value="">Not answering yet</option><option value="yes">Yes, it’s resolved</option><option value="no">No, I still need help</option></select>
                        <button class="button" type="submit" style="margin-top:10px;background:var(--green);border-color:var(--green);color:#fff">Send reply</button>
                    </form>
                @endif

                @if ($message->status === 'closed')
                    <section class="reply" style="margin-top:16px">
                        <h3 style="margin:0 0 6px;font-size:15px">How did we do?</h3>
                        <p class="muted" style="margin:0 0 12px">Rate the resolution and your support experience. You can update your rating later.</p>
                        <form method="post" action="{{ route('account.messages.rating', $message) }}">
                            @csrf
                            @foreach (['resolution_rating' => 'Was your issue resolved?', 'support_rating' => 'How was our customer support?'] as $field => $label)
                                <fieldset style="margin:12px 0;border:0;padding:0"><legend class="muted" style="font-weight:700">{{ $label }}</legend><div class="star-rating" role="radiogroup" aria-label="{{ $label }}">
                                    @for ($star = 5; $star >= 1; $star--)
                                        <input id="{{ $field }}-{{ $message->id }}-{{ $star }}" type="radio" name="{{ $field }}" value="{{ $star }}" required @checked((int) old($field, $message->{$field}) === $star)><label for="{{ $field }}-{{ $message->id }}-{{ $star }}" aria-label="{{ $star }} out of 5 stars">★</label>
                                    @endfor
                                </div></fieldset>
                            @endforeach
                            <label class="muted" for="feedback-{{ $message->id }}" style="display:block;font-weight:700;margin:10px 0 5px">Anything you’d like us to improve?</label>
                            <textarea id="feedback-{{ $message->id }}" name="support_feedback" maxlength="3000" rows="3" style="display:block;width:100%;padding:11px 12px;border:1px solid var(--line);border-radius:9px;background:#fff;color:var(--ink);font:inherit;resize:vertical">{{ old('support_feedback', $message->support_feedback) }}</textarea>
                            <button class="button" type="submit" style="margin-top:10px;background:var(--green);border-color:var(--green);color:#fff">Save rating</button>
                        </form>
                    </section>
                @endif
            </article>
        @empty
            <section class="message-card empty">
                <h2 style="margin:0 0 6px">No support messages yet</h2>
                <p class="muted" style="margin:0 0 15px">If you contact us while signed in, the conversation and any reply will be saved here.</p>
                <a class="button" href="{{ route('contact.show') }}">Contact support</a>
            </section>
        @endforelse

        @if ($messages->hasPages())<div class="pagination">{{ $messages->links() }}</div>@endif
    </main>
    <style>.star-rating{display:flex;flex-direction:row-reverse;justify-content:flex-end;gap:4px}.star-rating input{position:absolute;opacity:0;width:1px;height:1px}.star-rating label{color:#cbd5c3;cursor:pointer;font-size:27px;line-height:1}.star-rating input:checked+label,.star-rating label:hover,.star-rating label:hover~label{color:#d79a28}.star-rating input:focus-visible+label{outline:2px solid var(--green);outline-offset:2px;border-radius:3px}</style>
    @include('partials.site-footer')
</body>
</html>
