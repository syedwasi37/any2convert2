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

<section class="admin-section-grid" aria-label="Admin sections">
    <a class="admin-section-card" href="{{ route('admin.analytics') }}">
        <span class="admin-section-icon analytics" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19V5"/><path d="M4 19h17"/><path d="m7 15 4-4 3 2 5-6"/><path d="M16 7h3v3"/></svg></span>
        <h2 class="admin-section-title">Analytics</h2>
        <p class="admin-section-description">See what people use most and how visits change over time.</p>
        <span class="admin-section-arrow" aria-hidden="true"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
    </a>
    <a class="admin-section-card" href="{{ route('admin.users.index') }}">
        <span class="admin-section-icon users" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="9" cy="8" r="3.5"/><path d="M2.8 20v-1.3a6.2 6.2 0 0 1 12.4 0V20"/><path d="M16 5.2a3.5 3.5 0 0 1 0 6.7"/><path d="M18 14.5a5.6 5.6 0 0 1 3.2 5.1V20"/></svg></span>
        <h2 class="admin-section-title">User management</h2>
        <p class="admin-section-description">Review accounts and manage access when support is needed.</p>
        <span class="admin-section-arrow" aria-hidden="true"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
    </a>
    <a class="admin-section-card" href="{{ route('admin.contact.index') }}">
        <span class="admin-section-icon messages" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 11.5a7.5 7.5 0 0 1-7.5 7.5H6l-3 2v-9.5a7.5 7.5 0 1 1 17 0Z"/><path d="M8 11h8M8 14.5h5"/></svg></span>
        <h2 class="admin-section-title">Contact messages</h2>
        <p class="admin-section-description">Read visitor questions, add notes and send replies.</p>
        <span class="admin-section-arrow" aria-hidden="true"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
    </a>
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
