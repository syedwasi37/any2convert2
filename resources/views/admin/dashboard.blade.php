@extends('admin.contact.layout')
@section('title', 'Admin dashboard')
@section('content')
<div class="admin-heading">
    <div><h1>Admin panel</h1><p>A quick view of support activity and links to the tools you manage.</p></div>
</div>

<section aria-label="Site overview" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(155px,1fr));gap:12px;margin-bottom:18px">
    @foreach ([['Users', $totalUsers], ['Blocked users', $blockedUsers], ['All messages', $totalMessages], ['New messages', $newMessages], ['In progress', $inProgressMessages], ['Replied', $repliedMessages]] as [$label, $count])
        <article class="admin-panel" style="padding:16px 18px">
            <div class="admin-muted" style="font-size:12px">{{ $label }}</div>
            <strong style="display:block;margin-top:4px;font-size:26px;line-height:1.2">{{ $count }}</strong>
        </article>
    @endforeach
</section>

<section aria-label="Admin sections" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:12px;margin-bottom:18px">
    <a class="admin-panel" href="{{ route('admin.analytics') }}" style="text-decoration:none"><strong>Analytics</strong><p class="admin-muted" style="margin:5px 0 0">See page visits, popular tools and signup trends.</p></a>
    <a class="admin-panel" href="{{ route('admin.users.index') }}" style="text-decoration:none"><strong>User management</strong><p class="admin-muted" style="margin:5px 0 0">Review accounts and manage access.</p></a>
    <a class="admin-panel" href="{{ route('admin.contact.index') }}" style="text-decoration:none"><strong>Contact messages</strong><p class="admin-muted" style="margin:5px 0 0">Review questions and reply to visitors.</p></a>
</section>

<section class="admin-panel">
    <div style="display:flex;align-items:center;justify-content:space-between;gap:14px;flex-wrap:wrap;margin-bottom:14px">
        <div><h2 style="margin:0;font-size:18px">Contact messages</h2><p class="admin-muted" style="margin:4px 0 0">Read and reply to messages sent by visitors.</p></div>
        <a class="admin-button primary" href="{{ route('admin.contact.index') }}">Open inbox</a>
    </div>
    @forelse ($recentMessages as $message)
        <a href="{{ route('admin.contact.show', $message) }}" style="display:flex;align-items:center;justify-content:space-between;gap:14px;padding:12px 0;border-top:1px solid #e2e8f0;text-decoration:none">
            <span style="min-width:0"><strong style="display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $message->subject }}</strong><span class="admin-muted" style="font-size:12px">{{ $message->name }} · {{ $message->created_at?->format('M j, Y') }}</span></span>
            <span class="admin-status {{ $message->status }}">{{ str_replace('_', ' ', ucfirst($message->status)) }}</span>
        </a>
    @empty
        <p class="admin-muted" style="margin:0;padding-top:12px;border-top:1px solid #e2e8f0">No contact messages yet.</p>
    @endforelse
</section>
@endsection
