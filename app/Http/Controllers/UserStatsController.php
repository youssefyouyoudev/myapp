<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use Carbon\Carbon;

class UserStatsController extends Controller
{
    public function stats(Request $request)
    {
        $user = $request->user();

        // Time periods
        $today = Carbon::today();
        $yesterday = Carbon::yesterday();
        $now = Carbon::now();
        $startOfMonth = $now->copy()->startOfMonth();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfLastMonth = $now->copy()->subMonth()->endOfMonth();
        $startOfYear = $now->copy()->startOfYear();

        // Totals
        $totalPayments = Payment::sum('amount');
        $totalCount = Payment::count();

        // Today
        $todayAmount = Payment::whereDate('created_at', $today)->sum('amount');
        $todayCount = Payment::whereDate('created_at', $today)->count();

        // Yesterday
        $yesterdayAmount = Payment::whereDate('created_at', $yesterday)->sum('amount');

        // This month
        $thisMonthAmount = Payment::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->sum('amount');
        $thisMonthCount = Payment::whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        // Last month
        $lastMonthAmount = Payment::whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->sum('amount');

        // This year
        $thisYearAmount = Payment::whereYear('created_at', $now->year)->sum('amount');
        $thisYearCount = Payment::whereYear('created_at', $now->year)->count();

        // Top 5 users by payment amount this month
        $topUsers = Payment::selectRaw('user_id, SUM(amount) as total')
            ->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->with('user')
            ->limit(5)
            ->get();

        // Payment breakdown by method (all time)
        $byMethod = Payment::selectRaw('method, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('method')
            ->get();

        // Recent payments (last 5)
        $recent = Payment::with('user')->orderByDesc('created_at')->limit(5)->get();

        // Growth
        $todayGrowth = $yesterdayAmount > 0 ? (($todayAmount - $yesterdayAmount) / $yesterdayAmount) * 100 : null;
        $monthGrowth = $lastMonthAmount > 0 ? (($thisMonthAmount - $lastMonthAmount) / $lastMonthAmount) * 100 : null;

        return response()->json([
            'totals' => [
                'amount' => (float) $totalPayments,
                'count' => $totalCount,
            ],
            'today' => [
                'amount' => (float) $todayAmount,
                'count' => $todayCount,
                'growth' => $todayGrowth,
            ],
            'thisMonth' => [
                'amount' => (float) $thisMonthAmount,
                'count' => $thisMonthCount,
                'growth' => $monthGrowth,
            ],
            'thisYear' => [
                'amount' => (float) $thisYearAmount,
                'count' => $thisYearCount,
            ],
            'topUsers' => $topUsers,
            'byMethod' => $byMethod,
            'recent' => $recent,
        ]);
    }
}
