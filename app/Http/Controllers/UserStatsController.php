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


        // Only payments for the logged-in user
        $userPayments = Payment::where('user_id', $user->id);

        // Totals
        $totalPayments = (clone $userPayments)->sum('amount');
        $totalCount = (clone $userPayments)->count();

        // Today
        $todayAmount = (clone $userPayments)->whereDate('created_at', $today)->sum('amount');
        $todayCount = (clone $userPayments)->whereDate('created_at', $today)->count();

        // Yesterday
        $yesterdayAmount = (clone $userPayments)->whereDate('created_at', $yesterday)->sum('amount');

        // This month
        $thisMonthAmount = (clone $userPayments)->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->sum('amount');
        $thisMonthCount = (clone $userPayments)->whereYear('created_at', $now->year)
            ->whereMonth('created_at', $now->month)
            ->count();

        // Last month
        $lastMonthAmount = (clone $userPayments)->whereBetween('created_at', [$startOfLastMonth, $endOfLastMonth])->sum('amount');

        // This year
        $thisYearAmount = (clone $userPayments)->whereYear('created_at', $now->year)->sum('amount');
        $thisYearCount = (clone $userPayments)->whereYear('created_at', $now->year)->count();

        // Payment breakdown by method (all time)
        $byMethod = (clone $userPayments)
            ->selectRaw('method, SUM(amount) as total, COUNT(*) as count')
            ->groupBy('method')
            ->get();

        // Recent payments (last 5)
        $recent = (clone $userPayments)->with('user')->orderByDesc('created_at')->limit(5)->get();

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
            'byMethod' => $byMethod,
            'recent' => $recent,
        ]);
    }
}
