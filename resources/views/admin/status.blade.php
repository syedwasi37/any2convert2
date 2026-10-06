@extends('admin.contact.layout')
@section('title', 'Site status')
@section('content')
<div class="admin-heading"><div><h1>Site status</h1><p>A quick check of the services and setup that keep the site running.</p></div></div>

<section class="admin-health-grid" aria-label="Website health checks">
    @foreach ($checks as $check)
        <article class="admin-health-item">
            <span class="admin-health-indicator {{ $check['ready'] ? '' : 'check' }}" aria-hidden="true">
                @if ($check['ready'])
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="m5 12 4 4L19 6"/></svg>
                @else
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 8v5"/><path d="M12 17h.01"/><circle cx="12" cy="12" r="9"/></svg>
                @endif
            </span>
            <div><strong>{{ $check['title'] }}</strong><p>{{ $check['detail'] }}</p></div>
        </article>
    @endforeach
</section>

<p class="admin-muted" style="margin:16px 0 0;font-size:12px">This page checks configuration and database availability. It does not display passwords, server addresses, or private keys.</p>
@endsection
