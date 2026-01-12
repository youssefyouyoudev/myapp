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

        $today = Payment::where('user_id', $user->id)
            ->whereDate('created_at', Carbon::today())
            ->sum('amount');

        $thisMonth = Payment::where('user_id', $user->id)
            ->whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->sum('amount');

        $thisYear = Payment::where('user_id', $user->id)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('amount');

        return response()->json([
            'today' => (float) $today,
            'thisMonth' => (float) $thisMonth,
            'thisYear' => (float) $thisYear,
        ]);
    }
}
