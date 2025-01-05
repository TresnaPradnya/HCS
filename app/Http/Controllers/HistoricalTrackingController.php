<?php

namespace App\Http\Controllers;

use App\Models\HistoricalTracking;
use Illuminate\Http\Request;

class HistoricalTrackingController extends Controller
{
    public function index()
    {
        // Ambil data dari tabel historical_trackings
        $historicalData = HistoricalTracking::orderBy('date', 'asc')->get();

        return view('historical_trends.index', compact('historicalData'));
    }
}
