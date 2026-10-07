@extends('admin.contact.layout')
@section('title', 'Admin dashboard')
@section('content')
<div class="admin-heading">
    <div><h1>Admin panel</h1><p>Manage site sections and keep an eye on new account activity.</p></div>
</div>

<section class="admin-section-grid" aria-label="Admin sections">
    <a class="admin-section-card" href="{{ route('admin.analytics') }}">
        <span class="admin-section-icon analytics" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M4 19V5"/><path d="M4 19h17"/><path d="m7 15 4-4 3 2 5-6"/><path d="M16 7h3v3"/></svg></span>
        <h2 class="admin-section-title">Analytics</h2>
        <p class="admin-section-description">See what people use most and how visits change over time.</p>
        <span class="admin-section-arrow" aria-hidden="true"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
    </a>
    <a class="admin-section-card" href="{{ route('admin.status') }}">
        <span class="admin-section-icon analytics" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg></span>
        <h2 class="admin-section-title">Site status</h2>
        <p class="admin-section-description">Check the database, email delivery and essential site setup.</p>
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
    <a class="admin-section-card" href="{{ route('community.index') }}">
        <span class="admin-section-icon messages" aria-hidden="true"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M20 11.5a7.5 7.5 0 0 1-7.5 7.5H6l-3 2v-9.5a7.5 7.5 0 1 1 17 0Z"/><path d="M8 10h8M8 14h5"/><path d="M17 3h4v4"/></svg></span>
        <h2 class="admin-section-title">Community feedback</h2>
        <p class="admin-section-description">{{ number_format($communityPosts) }} public conversations · reply and moderate posts.</p>
        <span class="admin-section-arrow" aria-hidden="true"><svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></span>
    </a>
</section>

<section class="admin-panel" aria-labelledby="signupChartTitle" style="margin-bottom:18px">
    <div class="admin-chart-head">
        <div>
            <h2 id="signupChartTitle" style="margin:0;font-size:17px">New users</h2>
            <p class="admin-muted" style="margin:4px 0 0;font-size:13px">{{ number_format($newUsers) }} joined in the last 30 days · {{ number_format($totalUsers) }} accounts total</p>
        </div>
        @if ($newUsers > 0)
            <div class="admin-chart-ranges" role="group" aria-label="Signup chart date range">
                <button type="button" class="admin-chart-range" data-signup-range="7" aria-pressed="true">7 days</button>
                <button type="button" class="admin-chart-range" data-signup-range="30" aria-pressed="false">30 days</button>
            </div>
        @endif
    </div>
    @if ($newUsers > 0)
        <div class="admin-signup-bars" role="group" aria-label="Daily new account signups. Focus or point to a bar to see its date and count.">
            @foreach ($signupTrend as $point)
                @php($barHeight = $point['total'] > 0 ? max(7, round(($point['total'] / $maxSignups) * 100)) : 3)
                <button type="button" class="admin-signup-bar" data-signup-day data-age-days="{{ $point['age'] }}" aria-label="{{ $point['label'] }}: {{ $point['total'] }} new users" title="{{ $point['label'] }} · {{ $point['total'] }} {{ \Illuminate\Support\Str::plural('signup', $point['total']) }}" @if($point['age'] >= 7) hidden @endif>
                    <span class="admin-signup-fill" style="height:{{ $barHeight }}%" aria-hidden="true"></span>
                    <span class="admin-signup-label" data-signup-label @if($point['age'] >= 7) hidden @endif>{{ $point['label'] }}</span>
                </button>
            @endforeach
        </div>
        <div class="admin-chart-foot"><span>Daily signups</span><span>Hover or focus a bar for details</span></div>
    @else
        <div class="admin-chart-empty">New signups will appear here as accounts are created.</div>
    @endif
</section>

<script>
(() => {
    const chart = document.querySelector('.admin-signup-bars');
    if (!chart) return;

    const buttons = document.querySelectorAll('[data-signup-range]');
    const bars = chart.querySelectorAll('[data-signup-day]');
    const updateRange = (range) => {
        bars.forEach((bar) => {
            const age = Number(bar.dataset.ageDays);
            bar.hidden = range === 7 && age >= 7;
            const label = bar.querySelector('[data-signup-label]');
            label.hidden = range === 30 && age !== 0 && age % 5 !== 0;
        });
        buttons.forEach((button) => button.setAttribute('aria-pressed', String(Number(button.dataset.signupRange) === range)));
    };

    buttons.forEach((button) => button.addEventListener('click', () => updateRange(Number(button.dataset.signupRange))));
})();
</script>
@endsection
