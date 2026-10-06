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
        :root{--ink:#252923;--muted:#747b72;--line:#e7eae4;--paper:#fff;--wash:#f6f7f4;--green:#315b3d;--green-soft:#edf4eb}*{box-sizing:border-box}body{margin:0;background:var(--wash);color:var(--ink);font:15px/1.55 Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif}.messages-wrap{width:min(900px,calc(100% - 32px));margin:38px auto 64px}.messages-heading{display:flex;align-items:flex-end;justify-content:space-between;gap:18px;margin-bottom:22px}.eyebrow{margin:0;color:var(--green);font-size:11px;font-weight:750;letter-spacing:.13em;text-transform:uppercase}.messages-heading h1{margin:5px 0;font-size:clamp(27px,4vw,36px);line-height:1.15;letter-spacing:-.04em}.muted{color:var(--muted);font-size:13px}.message-card{margin:14px 0;padding:22px;border:1px solid var(--line);border-radius:15px;background:var(--paper);box-shadow:0 6px 24px #28362606}.message-top{display:flex;justify-content:space-between;gap:12px;align-items:flex-start}.message-top h2{margin:0;font-size:17px;letter-spacing:-.025em;overflow-wrap:anywhere}.pill{display:inline-flex;padding:4px 9px;border-radius:999px;background:#f1f3ef;color:#596258;font-size:11px;font-weight:750;text-transform:capitalize;white-space:nowrap}.body-copy{margin:15px 0 0;white-space:pre-wrap;overflow-wrap:anywhere;color:#434a41;font-size:14px}.reply{margin-top:17px;padding:16px;border:1px solid #dce8dc;border-radius:11px;background:#f7faf6}.reply-head{display:flex;justify-content:space-between;gap:10px;align-items:center;color:var(--green);font-size:13px;font-weight:750}.reply .body-copy{margin-top:9px}.empty{padding:34px 20px;text-align:center}.button{display:inline-flex;align-items:center;justify-content:center;min-height:40px;padding:0 14px;border:1px solid var(--line);border-radius:9px;background:white;color:#3b453a;text-decoration:none;font-size:13px;font-weight:700}.button:hover{border-color:#b9c9b7;background:#fbfdfb}.pagination{margin-top:18px}.status-note{margin-bottom:16px;padding:11px 14px;border:1px solid #cfe4ce;border-radius:9px;background:#f2faf1;color:#355a3b;font-size:13px}@media(max-width:560px){.messages-wrap{width:calc(100% - 24px);margin-top:24px}.messages-heading{align-items:flex-start;flex-direction:column}.message-card{padding:17px}.message-top{flex-direction:column}}
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
                    <div><h2>{{ $message->subject }}</h2><div class="muted">Sent {{ $message->created_at?->format('M j, Y · g:i a') ?? 'recently' }} · {{ ucfirst($message->category ?: 'general') }}</div></div>
                    <span class="pill">{{ str_replace('_', ' ', $message->status) }}</span>
                </div>
                <p class="body-copy">{{ $message->message }}</p>
                @forelse ($message->replies as $reply)
                    <section class="reply" aria-label="Reply from support">
                        <div class="reply-head"><span>Reply from Any2Convert support</span><time class="muted">{{ $reply->sent_at?->format('M j, Y · g:i a') ?? $reply->created_at?->format('M j, Y · g:i a') ?? '' }}</time></div>
                        <p class="body-copy">{{ $reply->body }}</p>
                        @if ($reply->delivery_status !== 'sent')<p class="muted" style="margin:10px 0 0">You can read this reply here. Email delivery is still pending.</p>@endif
                    </section>
                @empty
                    <p class="muted" style="margin:14px 0 0">Our team hasn’t replied yet. We’ll also email you when we respond.</p>
                @endforelse
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
    @include('partials.site-footer')
</body>
</html>
