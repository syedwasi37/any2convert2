@extends('admin.contact.layout')
@section('title', 'User management')
@section('content')
<div class="admin-heading"><div><h1>User management</h1><p>Review accounts and manage access to Any2Convert.</p></div></div>

<section style="display:grid;grid-template-columns:repeat(auto-fit,minmax(145px,1fr));gap:10px;margin-bottom:16px">
    @foreach ([['All accounts', $totalUsers], ['Blocked', $blockedUsers], ['Restricted', $restrictedUsers]] as [$label, $count])
        <article class="admin-panel" style="padding:14px 16px"><span class="admin-muted" style="font-size:12px">{{ $label }}</span><strong style="display:block;margin-top:3px;font-size:23px">{{ number_format($count) }}</strong></article>
    @endforeach
</section>

<section class="admin-panel">
    <form method="get" action="{{ route('admin.users.index') }}" style="display:grid;grid-template-columns:minmax(0,1fr) minmax(140px,190px) auto;gap:9px;margin-bottom:16px">
        <input class="admin-control" name="q" type="search" value="{{ request('q') }}" placeholder="Search name or email" aria-label="Search users">
        <select class="admin-control" name="status" aria-label="Filter by account status">
            @foreach (['all' => 'All accounts', 'active' => 'Active', 'blocked' => 'Blocked', 'restricted' => 'Restricted'] as $value => $label)
                <option value="{{ $value }}" @selected($status === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <button class="admin-button" type="submit">Filter</button>
    </form>

    <div style="display:grid;gap:12px">
        @forelse ($users as $user)
            <article style="padding:15px;border:1px solid #e2e8f0;border-radius:10px">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;gap:15px;flex-wrap:wrap">
                    <div style="min-width:200px;flex:1">
                        <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap"><strong>{{ $user->name ?: 'Unnamed user' }}</strong>
                            @if ($user->isAdmin())<span class="admin-status">Admin</span>@endif
                            @if ($user->is_blocked)<span class="admin-status closed">Blocked</span>@elseif ($user->is_restricted)<span class="admin-status in_progress">Restricted</span>@else<span class="admin-status replied">Active</span>@endif
                            @if ($user->hasPremiumAccess())<span class="admin-status">Premium</span>@endif
                        </div>
                        <div class="admin-muted" style="margin-top:4px;overflow-wrap:anywhere">{{ $user->email }}</div>
                        <div class="admin-muted" style="margin-top:5px;font-size:12px">
                            Account #{{ $user->id }} · {{ $user->email_verified_at ? 'Email verified' : 'Email not verified' }} · {{ $user->google_id ? 'Google sign-in' : 'Email account' }} ·
                            @if ($user->phone){{ $user->phone }} · @endif
                            @if ($user->country_name){{ $user->country_name }} · @endif
                            Joined {{ $user->created_at?->format('M j, Y') ?? 'date unavailable' }}
                        </div>
                        @if ($user->restriction_note)<div style="margin-top:8px;color:#92400e;font-size:12px">Restriction note: {{ $user->restriction_note }}</div>@endif
                    </div>
                    @if (! $user->isAdmin() && (string) $user->id !== (string) auth()->id())
                        <div style="display:flex;align-items:flex-end;gap:8px;flex-wrap:wrap">
                            @if ($user->is_blocked)
                                <form method="post" action="{{ route('admin.users.update-status', $user) }}">@csrf @method('PATCH')<input type="hidden" name="action" value="unblock"><button class="admin-button" type="submit">Unblock</button></form>
                            @else
                                <form method="post" action="{{ route('admin.users.update-status', $user) }}">@csrf @method('PATCH')<input type="hidden" name="action" value="block"><button class="admin-button danger" type="submit">Block</button></form>
                            @endif
                            @if ($user->is_restricted)
                                <form method="post" action="{{ route('admin.users.update-status', $user) }}">@csrf @method('PATCH')<input type="hidden" name="action" value="unrestrict"><button class="admin-button" type="submit">Remove restriction</button></form>
                            @else
                                <form method="post" action="{{ route('admin.users.update-status', $user) }}" style="display:flex;gap:6px;flex-wrap:wrap">@csrf @method('PATCH')<input class="admin-control" name="restriction_note" maxlength="500" placeholder="Reason (optional)" aria-label="Restriction reason" style="width:170px;min-height:36px"><input type="hidden" name="action" value="restrict"><button class="admin-button" type="submit">Restrict tools</button></form>
                            @endif
                        </div>
                    @endif
                </div>
            </article>
        @empty
            <p class="admin-muted" style="padding:20px;text-align:center">No accounts match this search.</p>
        @endforelse
    </div>
    <div class="admin-pagination">{{ $users->links() }}</div>
</section>
<p class="admin-muted" style="margin:12px 0 0;font-size:12px">Administrator accounts and your own account are protected from block/restriction actions.</p>
@endsection
