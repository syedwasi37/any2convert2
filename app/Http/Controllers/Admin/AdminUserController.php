<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->query('status', 'all');
        abort_unless(in_array($status, ['all', 'active', 'blocked', 'restricted'], true), 404);

        $users = User::query()
            ->when($request->filled('q'), function ($query) use ($request): void {
                $term = '%'.str_replace(['%', '_'], ['\\%', '\\_'], trim((string) $request->query('q'))).'%';
                $query->where(function ($nested) use ($term): void {
                    $nested->where('name', 'like', $term)->orWhere('email', 'like', $term);
                });
            })
            ->when($status === 'active', fn ($query) => $query->where('is_blocked', false)->where('is_restricted', false))
            ->when($status === 'blocked', fn ($query) => $query->where('is_blocked', true))
            ->when($status === 'restricted', fn ($query) => $query->where('is_restricted', true))
            ->orderByDesc('created_at')
            ->paginate(25)
            ->withQueryString();

        return view('admin.users.index', [
            'users' => $users,
            'status' => $status,
            'totalUsers' => User::count(),
            'blockedUsers' => User::where('is_blocked', true)->count(),
            'restrictedUsers' => User::where('is_restricted', true)->count(),
        ]);
    }

    public function updateStatus(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'action' => ['required', 'in:block,unblock,restrict,unrestrict'],
            'restriction_note' => ['nullable', 'string', 'max:500'],
        ]);

        abort_if($user->isAdmin(), 403, 'Administrator accounts cannot be modified here.');
        abort_if((string) $user->getKey() === (string) $request->user()->getKey(), 403, 'You cannot block or restrict your own account.');

        $fields = match ($data['action']) {
            'block' => ['is_blocked' => true, 'blocked_at' => now()],
            'unblock' => ['is_blocked' => false, 'blocked_at' => null],
            'restrict' => [
                'is_restricted' => true,
                'restricted_at' => now(),
                'restriction_note' => trim((string) ($data['restriction_note'] ?? '')) ?: null,
            ],
            'unrestrict' => ['is_restricted' => false, 'restricted_at' => null, 'restriction_note' => null],
        };

        $user->forceFill($fields)->save();

        return back()->with('status', 'Account access updated.');
    }
}
