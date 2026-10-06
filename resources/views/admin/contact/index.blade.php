@extends('admin.contact.layout')
@section('title', 'Contact inbox')
@section('content')
<div class="admin-heading"><div><h1>Contact inbox</h1><p>Review questions, feedback, and tool reports sent from the website.</p></div></div>
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(125px,1fr));gap:10px;margin-bottom:16px">
    @foreach (['new' => 'New', 'in_progress' => 'In progress', 'replied' => 'Replied', 'closed' => 'Closed', 'spam' => 'Spam'] as $key => $label)
        <a href="{{ route('admin.contact.index', ['status' => $key]) }}" class="admin-panel" style="padding:13px 15px;text-decoration:none;{{ $status === $key ? 'border-color:#60a5fa;background:#eff6ff' : '' }}">
            <span class="admin-muted" style="display:block;font-size:12px">{{ $label }}</span><strong style="font-size:21px">{{ $counts[$key] ?? 0 }}</strong>
        </a>
    @endforeach
</div>
<section class="admin-panel">
    <form method="get" action="{{ route('admin.contact.index') }}" style="display:flex;gap:10px;margin-bottom:15px">
        @if ($status)<input type="hidden" name="status" value="{{ $status }}">@endif
        <input class="admin-control" name="q" type="search" value="{{ request('q') }}" placeholder="Search name, email, subject, or message" aria-label="Search inbox">
        <button class="admin-button" type="submit">Search</button>
        @if (request()->filled('q') || $status)<a class="admin-button" href="{{ route('admin.contact.index') }}">Clear</a>@endif
    </form>
    <div style="display:grid;gap:9px">
        @forelse ($messages as $message)
            <a href="{{ route('admin.contact.show', $message) }}" style="display:grid;grid-template-columns:minmax(0,1fr) auto;gap:12px;align-items:center;padding:14px;border:1px solid #e2e8f0;border-radius:9px;text-decoration:none">
                <div style="min-width:0">
                    <div style="display:flex;flex-wrap:wrap;align-items:center;gap:8px"><strong style="overflow-wrap:anywhere">{{ $message->subject }}</strong><span class="admin-status {{ $message->status }}">{{ str_replace('_', ' ', ucfirst($message->status)) }}</span></div>
                    <div class="admin-muted" style="margin-top:3px">{{ $message->name }} · {{ $message->email }} · {{ ucfirst($message->category) }}</div>
                    <div class="admin-muted" style="overflow:hidden;text-overflow:ellipsis;white-space:nowrap;margin-top:5px">{{ $message->message }}</div>
                </div>
                <time class="admin-muted" style="font-size:12px;white-space:nowrap" datetime="{{ $message->created_at?->toIso8601String() ?? '' }}">{{ $message->created_at?->format('M j, Y · g:i a') ?? 'Date unavailable' }}</time>
            </a>
        @empty
            <div style="padding:40px 12px;text-align:center"><strong>No messages found</strong><p class="admin-muted" style="margin:5px 0 0">New contact messages will appear here.</p></div>
        @endforelse
    </div>
    @if ($messages->hasPages())<div class="admin-pagination">{{ $messages->links() }}</div>@endif
</section>
@endsection
