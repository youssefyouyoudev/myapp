<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all logs
        $logs = Log::all();
        return response()->json($logs);

    }
    public function getByUserIdAndDateRange(Request $request, $user_id)
    {
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');
        if (!$startDate || !$endDate) {
            return response()->json(['error' => 'start_date and end_date query parameters are required'], 400);
        }
        $logs = Log::where('user_id', $user_id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();
        $count = $logs->count();
        // Get total amount from payments table for this user and date range
        $totalAmount = \App\Models\Payment::where('user_id', $user_id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->sum('amount');
        return response()->json([
            'logs' => $logs,
            'count' => $count,
            'total_amount' => $totalAmount,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'logs' => 'required|array',
            'logs.*.user_id' => 'nullable|integer|exists:users,id',
            'logs.*.action' => 'required|string',
            'logs.*.model' => 'required|string',
            'logs.*.model_id' => 'nullable|integer',
            'logs.*.details' => 'nullable',
        ]);

        $created = [];
        foreach ($data['logs'] as $log) {
            $created[] = \App\Models\Log::create($log);
        }
        return response()->json([
            'message' => 'Logs stored successfully',
            'logs' => $created,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Log $log)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Log $log)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Log $log)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Log $log)
    {
        //
    }
}
