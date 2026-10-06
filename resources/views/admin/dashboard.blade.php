@extends('admin.contact.layout')
@section('title', 'Admin dashboard')
@section('content')
<div class="admin-heading">
    <div><h1>Admin panel</h1><p>A quick view of support activity and links to the tools you manage.</p></div>
</div>

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
        @if ($newMessages > 0)<span class="admin-section-count" aria-label="{{ $newMessages }} unread messages">{{ $newMessages > 99 ? '99+' : $newMessages }}</span>@endif
        <h2 class="admin-section-title">Contact messages</h2>
        <p class="admin-section-description">Read visitor questions, add notes and send replies.</p>
        <span class="admin-section-arrow" aria-hidden="true"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
    </a>
</section>
@endsection
