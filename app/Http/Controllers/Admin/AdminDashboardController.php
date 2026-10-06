<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\User;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $today = now()->startOfDay();
        $signupCounts = User::query()
            ->where('created_at', '>=', $today->copy()->subDays(29))
            ->selectRaw('DATE(created_at) as signup_day, COUNT(*) as total')
            ->groupBy('signup_day')
            ->pluck('total', 'signup_day');

        $signupTrend = collect(range(29, 0))->map(function (int $daysAgo) use ($today, $signupCounts): array {
            $date = $today->copy()->subDays($daysAgo);
            $day = $date->toDateString();

            return [
                'day' => $day,
                'label' => $date->format('M j'),
                'age' => $daysAgo,
                'total' => (int) ($signupCounts[$day] ?? 0),
            ];
        });

        return view('admin.dashboard', [
            'newMessages' => ContactMessage::where('status', 'new')->count(),
            'totalUsers' => User::count(),
            'newUsers' => $signupTrend->sum('total'),
            'signupTrend' => $signupTrend,
            'maxSignups' => max(1, (int) $signupTrend->max('total')),
        ]);
    }
}
