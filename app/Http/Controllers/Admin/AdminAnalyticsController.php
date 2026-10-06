<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteAnalyticsEvent;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminAnalyticsController extends Controller
{
    public function index(): View
    {
        $since = now()->subDays(29)->startOfDay();
        $dailyViews = SiteAnalyticsEvent::query()
            ->where('event_type', 'page_view')
            ->where('created_at', '>=', $since)
            ->selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->orderBy('day')
            ->get();
        $topTools = SiteAnalyticsEvent::query()
            ->where('event_type', 'tool_open')
            ->where('created_at', '>=', $since)
            ->select('event_value', DB::raw('COUNT(*) as total'))
            ->groupBy('event_value')
            ->orderByDesc('total')
            ->limit(8)
            ->get();
        $topPages = SiteAnalyticsEvent::query()
            ->where('event_type', 'page_view')
            ->where('created_at', '>=', $since)
            ->select('event_value', DB::raw('COUNT(*) as total'))
            ->groupBy('event_value')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return view('admin.analytics', [
            'pageViews' => SiteAnalyticsEvent::where('event_type', 'page_view')->where('created_at', '>=', $since)->count(),
            'toolOpens' => SiteAnalyticsEvent::where('event_type', 'tool_open')->where('created_at', '>=', $since)->count(),
            'newAccounts' => User::where('created_at', '>=', $since)->count(),
            'totalAccounts' => User::count(),
            'dailyViews' => $dailyViews,
            'topTools' => $topTools,
            'topPages' => $topPages,
            'maxDailyViews' => max(1, (int) $dailyViews->max('total')),
        ]);
    }
}
