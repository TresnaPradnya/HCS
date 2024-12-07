<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    public function index(Request $request)
    {
        $startDate = $request->query('start_date', now()->toDateString());
        $endDate = $request->query('end_date', now()->toDateString());

        $activityLogs = ActivityLog::with('commutingMethod', 'dietaryPreference', 'energySource')
            ->where('user_id', Auth::id())
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        // Calculate Footprints by category (Transportation, Energy, Diet) and prepare the system's response.
        $transportation_footprint = $activityLogs->sum(function ($log) {
            return $log->commuting_method_value * ($log->commutingMethod->value ?? 0);
        });

        $energy_footprint = $activityLogs->sum(function ($log) {
            return $log->energy_source_value * ($log->energySource->value ?? 0);
        });

        $diet_footprint = $activityLogs->sum(function ($log) {
            return $log->dietary_preference_value * ($log->dietaryPreference->value ?? 0);
        });

        // Total Footprint (System Response: Overall carbon impact)
        $total_footprint = $transportation_footprint + $energy_footprint + $diet_footprint;

        // Prepare historical data (Optional, for tracking past performance)
        $allLogs = ActivityLog::with('commutingMethod', 'dietaryPreference', 'energySource')
            ->where('user_id', Auth::id())
            ->whereBetween('date', [$startDate, $endDate])
            ->get();

        $historicalData = $allLogs->groupBy('date');
        $dates = $historicalData->keys();

        // Prepare historical footprint data for charting (System Response: Historical insights)
        $transportation_history = $historicalData->map(function ($logs) {
            return $logs->sum(function ($log) {
                return $log->commuting_method_value * ($log->commutingMethod->value ?? 0);
            });
        })->values();

        $energy_history = $historicalData->map(function ($logs) {
            return $logs->sum(function ($log) {
                return $log->energy_source_value * ($log->energySource->value ?? 0);
            });
        })->values();

        $diet_history = $historicalData->map(function ($logs) {
            return $logs->sum(function ($log) {
                return $log->dietary_preference_value * ($log->dietaryPreference->value ?? 0);
            });
        })->values();

        // Pass data to the view (System Response: Present the breakdown to the user)
        return view('index', compact(
            'startDate',
            'endDate',
            'transportation_footprint',
            'energy_footprint',
            'diet_footprint',
            'total_footprint',
            'dates',
            'transportation_history',
            'energy_history',
            'diet_history'
        ));
    }
}
