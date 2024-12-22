<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    //
    public function index()
    {
        $userId = Auth::id();

        // Ambil aktivitas log pengguna berdasarkan user_id
        $result = ActivityLog::with(['commutingMethod', 'dietaryPreference', 'energySource'])
            ->where('user_id', $userId)
            ->get()
            ->groupBy('user_id')
            ->map(function ($item) {
                $total_commuting = $item->sum(function ($log) {
                    return $log->commutingMethod->value * $log->commuting_method_value;
                });

                $total_dietary = $item->sum(function ($log) {
                    return $log->dietaryPreference->value * $log->dietary_preference_value;
                });

                $total_energy = $item->sum(function ($log) {
                    return $log->energySource->value * $log->energy_source_value;
                });

                $total_activity_value = $total_commuting + $total_dietary + $total_energy;

                return (object) [
                    'total_commuting' => $total_commuting,
                    'total_dietary' => $total_dietary,
                    'total_energy' => $total_energy,
                    'total_activity_value' => $total_activity_value
                ];
            });

        // Ambil data pertama jika ada
        $data = $result->first();

        return view('recommendation.index', compact('data'));
    }
}
