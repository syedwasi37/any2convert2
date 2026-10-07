<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    @include('partials.site-theme')
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="robots" content="index,follow">
    <title>Community · Any2Convert</title>
    <meta name="description" content="Ask questions, share ideas, and help other people use Any2Convert tools.">
    @include('partials.tailwind-assets')
    <style>
        :root{--ink:#252923;--muted:#747b72;--line:#e7eae4;--paper:#fff;--wash:#f6f7f4;--green:#315b3d;--soft:#edf4eb;--accent:#dce9d8}
        html.dark{--ink:#edf0e9;--muted:#a3ab9e;--line:#343b33;--paper:#1b201b;--wash:#111511;--green:#a5cba8;--soft:#202b21;--accent:#2b3c2b;color-scheme:dark}
        *{box-sizing:border-box}body{margin:0;background:var(--wash);color:var(--ink);font:15px/1.55 Inter,ui-sans-serif,system-ui,-apple-system,"Segoe UI",sans-serif}
        a{color:inherit}.community-wrap{width:min(1040px,calc(100% - 40px));margin:34px auto 68px}
        .hero{position:relative;overflow:hidden;display:grid;grid-template-columns:minmax(0,1fr) auto;align-items:end;gap:26px;padding:34px;border:1px solid var(--line);border-radius:18px;background:var(--paper)}
        .hero:after{position:absolute;right:-75px;top:-130px;width:330px;height:330px;border:1px solid var(--accent);border-radius:50%;content:"";pointer-events:none}
        .hero-copy,.hero-action{position:relative;z-index:1}.eyebrow{margin:0;color:var(--green);font-size:11px;font-weight:750;letter-spacing:.14em;text-transform:uppercase}
        h1{margin:7px 0 0;font-size:clamp(30px,5vw,46px);line-height:1.05;letter-spacing:-.055em}.intro{max-width:570px;margin:13px 0 0;color:var(--muted);font-size:15px}
        .hero-action{display:flex;align-items:center;gap:12px}.count{color:var(--muted);font-size:12px;text-align:right}.count strong{display:block;color:var(--ink);font-size:20px}
        .layout{display:grid;grid-template-columns:minmax(0,1fr) 290px;gap:20px;align-items:start;margin-top:20px}.feed{min-width:0}.side{display:grid;gap:14px}
        .panel,.post-card{border:1px solid var(--line);border-radius:14px;background:var(--paper)}.panel{padding:21px}.panel h2{margin:0;font-size:17px;letter-spacing:-.025em}.panel-copy{margin:5px 0 16px;color:var(--muted);font-size:13px}
        .composer{margin-bottom:16px}.post-form{display:grid;gap:12px}.post-form label{display:block;color:var(--muted);font-size:12px;font-weight:700}.control{display:block;width:100%;margin-top:6px;padding:11px 12px;border:1px solid var(--line);border-radius:8px;background:var(--wash);color:var(--ink);font:inherit;font-size:14px}.control:focus{outline:2px solid color-mix(in srgb,var(--green) 28%,transparent);border-color:var(--green)}textarea.control{min-height:112px;resize:vertical}
        .button{display:inline-flex;align-items:center;justify-content:center;min-height:40px;padding:0 14px;border:1px solid var(--line);border-radius:8px;background:var(--paper);color:var(--ink);font:inherit;font-size:13px;font-weight:700;text-decoration:none;cursor:pointer}.button:hover{border-color:var(--green)}.primary{background:var(--green);border-color:var(--green);color:#fff}.danger{color:#a23d32}.button-row{display:flex;align-items:center;justify-content:space-between;gap:12px;flex-wrap:wrap}.notice{margin-bottom:14px;padding:11px 14px;border:1px solid var(--line);border-radius:9px;background:var(--soft);color:var(--green);font-size:13px}.error{color:#a23d32;font-size:12px;font-weight:500}
        .feed-heading{display:flex;justify-content:space-between;align-items:baseline;gap:10px;margin:20px 2px 10px}.feed-heading h2{margin:0;font-size:17px}.feed-heading span{color:var(--muted);font-size:12px}
        .post-card{margin:10px 0;padding:20px;transition:border-color .16s ease}.post-card:hover{border-color:color-mix(in srgb,var(--green) 45%,var(--line))}.post-head{display:flex;align-items:flex-start;justify-content:space-between;gap:15px}.post-title{margin:0;font-size:18px;line-height:1.35;letter-spacing:-.025em}.post-title a{text-decoration:none}.post-title a:hover{color:var(--green)}.meta{margin-top:6px;color:var(--muted);font-size:12px}.post-body{margin:12px 0 0;white-space:pre-wrap;overflow-wrap:anywhere}.tag{display:inline-flex;align-items:center;padding:4px 9px;border-radius:99px;background:var(--soft);color:var(--green);font-size:10px;font-weight:750;letter-spacing:.04em;text-transform:uppercase}
        .actions{display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-top:15px}.actions form{margin:0}.actions .button{min-height:35px;padding:0 11px;font-size:12px}.actions details{position:relative}.edit-form{display:grid;gap:10px;min-width:min(380px,calc(100vw - 48px));padding:14px;margin-top:8px;border:1px solid var(--line);border-radius:10px;background:var(--paper)}
        .info-list{display:grid;gap:12px;margin:14px 0 0;padding:0;list-style:none}.info-list li{display:flex;gap:10px;color:var(--muted);font-size:13px}.bullet{display:grid;place-items:center;flex:0 0 22px;width:22px;height:22px;border-radius:50%;background:var(--soft);color:var(--green);font-size:12px;font-weight:800}
        .empty{padding:34px 20px;text-align:center}.empty-mark{display:grid;place-items:center;width:48px;height:48px;margin:0 auto 12px;border:1px solid var(--line);border-radius:50%;color:var(--green);font-size:21px}.empty h2{margin:0;font-size:17px}.empty p{margin:6px 0 0;color:var(--muted);font-size:13px}.pagination{margin-top:18px}
        @media(max-width:760px){.community-wrap{width:min(100% - 28px,640px);margin-top:22px}.hero{grid-template-columns:1fr;align-items:start;padding:25px}.hero-action{justify-content:space-between}.layout{grid-template-columns:1fr}.side{grid-template-columns:1fr 1fr}.post-card{padding:17px}}
        @media(max-width:520px){.side{grid-template-columns:1fr}.hero{padding:21px}.hero-action{align-items:flex-end}.post-head{gap:8px}.post-title{font-size:16px}.button-row{align-items:stretch;flex-direction:column}.button-row .button{width:100%}.actions{gap:6px}.actions .button{min-height:38px}}
        @media(prefers-reduced-motion:reduce){*,*:before,*:after{scroll-behavior:auto!important;transition:none!important}}
    </style>
</head>
<body>
@include('partials.site-navbar')
<main class="community-wrap">
    @if(session('status'))<div class="notice" role="status">{{ session('status') }}</div>@endif
    <header class="hero">
        <div class="hero-copy"><p class="eyebrow">A place to share what works</p><h1>Community</h1><p class="intro">Ask a question, trade a useful tip, or suggest what we should build next. Keep it kind and leave private details out of public posts.</p></div>
        <div class="hero-action">@if($available)<div class="count"><strong>{{ number_format($posts->total()) }}</strong> conversations</div>@endif<a class="button" href="{{ route('contact.show', ['category' => 'feedback']) }}">Private support</a></div>
    </header>

    @if(!$available)
        <section class="panel" style="margin-top:20px"><h2>Community is getting ready</h2><p class="panel-copy" style="margin-bottom:0">The discussion board is temporarily unavailable. You can still <a href="{{ route('contact.show') }}">contact our team privately</a>.</p></section>
    @else
    <div class="layout">
        <section class="feed" aria-label="Community conversations">
            @auth
                @if(auth()->user()->is_restricted && !auth()->user()->isAdmin())
                    <div class="panel"><h2>Posting is paused for your account</h2><p class="panel-copy" style="margin-bottom:0">You can still read conversations. Contact support if you think this is a mistake.</p></div>
                @else
                    <section class="panel composer"><h2>Start a conversation</h2><p class="panel-copy">Give it a clear title so others can find it later.</p>
                        <form class="post-form" method="post" action="{{ route('community.store') }}">@csrf
                            <label>Title<input class="control" name="title" value="{{ old('title') }}" maxlength="180" minlength="5" placeholder="What would you like help with?" required></label>
                            @error('title')<span class="error">{{ $message }}</span>@enderror
                            <label>Your post<textarea class="control" name="body" rows="4" maxlength="12000" minlength="10" placeholder="Share the details that will help people respond." required>{{ old('body') }}</textarea></label>
                            @error('body')<span class="error">{{ $message }}</span>@enderror
                            <div class="button-row"><span class="muted">Public post · avoid personal or sensitive information</span><button class="button primary" type="submit">Post conversation</button></div>
                        </form>
                    </section>
                @endif
            @else
                <section class="panel button-row"><div><h2>Join the conversation</h2><p class="panel-copy" style="margin-bottom:0">Sign in to post, reply, and manage your conversations.</p></div><a class="button primary" href="{{ route('login', ['redirect' => request()->fullUrl()]) }}">Sign in</a></section>
            @endauth

            <div class="feed-heading"><h2>Recent conversations</h2><span>Newest first</span></div>
            @forelse($posts as $post)
                <article class="post-card">
                    <div class="post-head"><div><h3 class="post-title"><a href="{{ route('community.show', $post) }}">{{ $post->title }}</a></h3><div class="meta">{{ $post->author?->name ?? 'Community member' }} · {{ $post->created_at?->format('M j, Y') }} · {{ $post->comments_count }} {{ \Illuminate\Support\Str::plural('reply', $post->comments_count) }}</div></div>@if($post->status !== 'published')<span class="tag">Hidden</span>@endif</div>
                    <p class="post-body">{{ \Illuminate\Support\Str::limit($post->body, 360) }}</p>
                    <div class="actions"><a class="button primary" href="{{ route('community.show', $post) }}">Read conversation</a>
                        @if(auth()->check() && (auth()->user()->isAdmin() || (int)$post->user_id === (int)auth()->id()))
                            <details><summary class="button">Edit</summary><form class="edit-form" method="post" action="{{ route('community.update', $post) }}">@csrf @method('PATCH')<label class="muted">Title<input class="control" name="title" value="{{ $post->title }}" maxlength="180" required></label><label class="muted">Post<textarea class="control" name="body" rows="4" maxlength="12000" required>{{ $post->body }}</textarea></label><button class="button primary" type="submit">Save changes</button></form></details>
                            <form method="post" action="{{ route('community.delete', $post) }}" onsubmit="return confirm('Delete this conversation and its replies?')">@csrf @method('DELETE')<button class="button danger" type="submit">Delete</button></form>
                        @endif
                        @if(auth()->check() && auth()->user()->isAdmin())<form method="post" action="{{ route('admin.community.moderate', $post) }}">@csrf @method('PATCH')<input type="hidden" name="status" value="{{ $post->status === 'published' ? 'hidden' : 'published' }}"><button class="button" type="submit">{{ $post->status === 'published' ? 'Hide' : 'Publish' }}</button></form>@endif
                    </div>
                </article>
            @empty
                <section class="panel empty"><div class="empty-mark" aria-hidden="true">✳</div><h2>Nothing here yet</h2><p>Start a conversation and make this space useful for everyone.</p></section>
            @endforelse
            @if($posts->hasPages())<div class="pagination">{{ $posts->links() }}</div>@endif
        </section>
        <aside class="side">
            <section class="panel"><h2>A good place to start</h2><ul class="info-list"><li><span class="bullet">1</span><span>Share the tool name and what you were trying to do.</span></li><li><span class="bullet">2</span><span>Include the useful details; never post passwords or private files.</span></li><li><span class="bullet">3</span><span>Reply with what worked so the next person can learn too.</span></li></ul></section>
            <section class="panel"><h2>Need a private answer?</h2><p class="panel-copy">Account or billing details belong in a private support message.</p><a class="button" href="{{ route('contact.show') }}">Contact support</a></section>
        </aside>
    </div>
    @endif
</main>
@include('partials.site-footer')
</body>
</html>
