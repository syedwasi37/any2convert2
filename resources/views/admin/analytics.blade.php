@extends('admin.contact.layout')
@section('title', 'Analytics')
@section('content')
<div class="admin-heading"><div><h1>Analytics</h1><p>Privacy-friendly site activity for the last 30 days.</p></div></div>

<section style="display:grid;grid-template-columns:repeat(auto-fit,minmax(185px,1fr));gap:12px;margin-bottom:18px" aria-label="Analytics summary">
    @foreach ([['Page views', $pageViews], ['Tool opens', $toolOpens], ['New accounts', $newAccounts], ['All accounts', $totalAccounts]] as [$label, $count])
        <article class="admin-panel" style="padding:16px 18px"><div class="admin-muted" style="font-size:12px">{{ $label }}</div><strong style="display:block;margin-top:4px;font-size:26px;line-height:1.2">{{ number_format($count) }}</strong></article>
    @endforeach
</section>

<section class="admin-panel" style="margin-bottom:16px">
    <h2 style="margin:0 0 14px;font-size:17px">Daily page views</h2>
    @forelse ($dailyViews as $day)
        <div style="display:grid;grid-template-columns:92px minmax(0,1fr) 48px;align-items:center;gap:10px;margin:9px 0">
            <span class="admin-muted" style="font-size:12px">{{ \Illuminate\Support\Carbon::parse($day->day)->format('M j') }}</span>
            <span style="height:10px;border-radius:999px;background:#eef2f7;overflow:hidden"><span style="display:block;width:{{ max(2, round(((int) $day->total / $maxDailyViews) * 100)) }}%;height:100%;border-radius:inherit;background:#34795a"></span></span>
            <strong style="font-size:12px;text-align:right">{{ number_format($day->total) }}</strong>
        </div>
    @empty
        <p class="admin-muted" style="margin:0">Analytics will appear here as visitors use the site.</p>
    @endforelse
</section>

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:16px">
    @foreach ([['Popular tools', $topTools], ['Popular pages', $topPages]] as [$title, $items])
        <section class="admin-panel"><h2 style="margin:0 0 12px;font-size:17px">{{ $title }}</h2>
            @forelse ($items as $item)
                <div style="display:flex;justify-content:space-between;gap:12px;padding:10px 0;border-top:1px solid #e2e8f0"><span style="overflow-wrap:anywhere">{{ $item->event_value ?: 'Unknown' }}</span><strong>{{ number_format($item->total) }}</strong></div>
            @empty
                <p class="admin-muted" style="margin:0">No activity recorded yet.</p>
            @endforelse
        </section>
    @endforeach
</div>
<p class="admin-muted" style="margin:14px 0 0;font-size:12px">Visits are counted without storing IP addresses, cookies, or account identifiers.</p>
@endsection
