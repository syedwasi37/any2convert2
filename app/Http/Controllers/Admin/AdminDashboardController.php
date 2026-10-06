<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'totalMessages' => ContactMessage::count(),
            'newMessages' => ContactMessage::where('status', 'new')->count(),
            'inProgressMessages' => ContactMessage::where('status', 'in_progress')->count(),
            'repliedMessages' => ContactMessage::where('status', 'replied')->count(),
            'recentMessages' => ContactMessage::query()->latest()->limit(5)->get(),
        ]);
    }
}
