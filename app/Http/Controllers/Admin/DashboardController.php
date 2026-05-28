<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'registrations' => Registration::count(),
            'participants' => (int) Registration::sum('participant_count'),
            'revenue' => (int) Registration::sum('total_amount'),
            'pending' => Registration::where('status', 'pending')->count(),
            'confirmed' => Registration::where('status', 'confirmed')->count(),
        ];

        $byStatus = Registration::query()
            ->select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $byTier = Registration::query()
            ->select('tier', DB::raw('count(*) as total'))
            ->groupBy('tier')
            ->pluck('total', 'tier');

        $byPayment = Registration::query()
            ->select('payment_mode', DB::raw('count(*) as total'))
            ->groupBy('payment_mode')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'payment_mode');

        $daily = Registration::query()
            ->select(DB::raw('date(created_at) as day'), DB::raw('count(*) as total'))
            ->where('created_at', '>=', now()->subDays(13))
            ->groupBy('day')
            ->orderBy('day')
            ->pluck('total', 'day');

        $maxDaily = max($daily->max() ?? 1, 1);

        $recent = Registration::query()
            ->latest()
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'byStatus',
            'byTier',
            'byPayment',
            'daily',
            'maxDaily',
            'recent',
        ));
    }
}
