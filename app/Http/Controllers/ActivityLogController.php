<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\EnergySourceModel;
use Illuminate\Routing\Controller;
use App\Models\CommutingMethodsModel;
use App\Models\HistoricalTracking;
use App\Models\DietaryPreferencesModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class ActivityLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [
            'activity_logs' => ActivityLog::with(
                'user',
                'commutingMethod',
                'dietaryPreference',
                'energySource'
            )->get(),
        ];
        return view('activity_log.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $data = [
            'cm' => CommutingMethodsModel::all(),
            'es' => EnergySourceModel::all(),
            'dp' => DietaryPreferencesModel::all(),
        ];
        return view('activity_log.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'commuting_method_id' => 'required|exists:commuting_methods,id',
            'energy_source_id' => 'required|exists:energy_sources,id',
            'dietary_preference_id' => 'required|exists:dietary_preferences,id',
            'date' => 'required|date',
            'commuting_method_value' => 'required|numeric',
            'energy_source_value' => 'required|numeric'
        ]);

        // Simpan ke tabel activity_logs
        $activityLog = ActivityLog::create([
            'user_id' => Auth::id(),
            'commuting_method_id' => $request->commuting_method_id,
            'energy_source_id' => $request->energy_source_id,
            'dietary_preference_id' => $request->dietary_preference_id,
            'date' => $request->date,
            'commuting_method_value' => $request->commuting_method_value,
            'dietary_preference_value' => 1,
            'energy_source_value' => $request->energy_source_value
        ]);

        // Sinkronisasi ke historical_trackings
        $historical = HistoricalTracking::firstOrNew([
            'user_id' => Auth::id(),
            'date' => $request->date,
        ]);

        // Update nilai historis
        $historical->commuting_method_value += $request->commuting_method_value;
        $historical->energy_source_value += $request->energy_source_value;
        $historical->dietary_preference_value += 1; // Default value
        $historical->carbon_footprint = $historical->commuting_method_value + $historical->energy_source_value + $historical->dietary_preference_value;

        $historical->save();

        return redirect()->route('al.index')->with('success', 'Activity log created and historical tracking updated successfully!');
    }




    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $data = [
            'cm' => CommutingMethodsModel::all(),
            'es' => EnergySourceModel::all(),
            'dp' => DietaryPreferencesModel::all(),
            'al' => ActivityLog::find($id)
        ];
        return view('activity_log.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'commuting_method_id' => 'required|exists:commuting_methods,id',
            'energy_source_id' => 'required|exists:energy_sources,id',
            'dietary_preference_id' => 'required|exists:dietary_preferences,id',
            'date' => 'required|date',
            'commuting_method_value' => 'required|numeric',
            'energy_source_value' => 'required|numeric'
        ]);

        $activityLog = ActivityLog::findOrFail($id);

        // Perbarui data activity_logs
        $activityLog->update([
            'commuting_method_id' => $request->commuting_method_id,
            'energy_source_id' => $request->energy_source_id,
            'dietary_preference_id' => $request->dietary_preference_id,
            'date' => $request->date,
            'commuting_method_value' => $request->commuting_method_value,
            'dietary_preference_value' => 1,
            'energy_source_value' => $request->energy_source_value,
        ]);

        // Perbarui data di historical_trackings
        $historical = HistoricalTracking::firstOrNew([
            'user_id' => Auth::id(),
            'date' => $request->date,
        ]);

        $historical->commuting_method_value = $request->commuting_method_value;
        $historical->energy_source_value = $request->energy_source_value;
        $historical->dietary_preference_value = 1; // Default value
        $historical->carbon_footprint = $historical->commuting_method_value + $historical->energy_source_value + $historical->dietary_preference_value;

        $historical->save();

        return redirect()->route('al.index')->with('success', 'Activity log and historical tracking updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        ActivityLog::destroy($id);
        return redirect()->route('al.index')->with([
            'success' => 'Activity log deleted successfully'
        ]);
    }
    public function historicalTrends(Request $request)
    {
        // Ambil rentang tanggal dari request atau default ke 30 hari terakhir
        $startDate = $request->start_date ?? now()->subDays(30)->format('Y-m-d');
        $endDate = $request->end_date ?? now()->format('Y-m-d');

        // Ambil data aktivitas dalam rentang waktu tertentu
        $activityLogs = ActivityLog::whereBetween('date', [$startDate, $endDate])->get();

        // Group data berdasarkan tanggal
        $groupedData = $activityLogs->groupBy('date');

        // Inisialisasi data untuk grafik
        $dates = [];
        $transportationHistory = [];
        $energyHistory = [];
        $dietHistory = [];

        foreach ($groupedData as $date => $logs) {
            $dates[] = $date;

            // Hitung total per kategori
            $transportationHistory[] = $logs->sum('commuting_method_value');
            $energyHistory[] = $logs->sum('energy_source_value');
            $dietHistory[] = $logs->sum('dietary_preference_value');
        }

        // Total seluruh jejak karbon
        $transportationFootprint = $activityLogs->sum('commuting_method_value');
        $energyFootprint = $activityLogs->sum('energy_source_value');
        $dietFootprint = $activityLogs->sum('dietary_preference_value');
        $totalFootprint = $transportationFootprint + $energyFootprint + $dietFootprint;

        // Kirim data ke view
        return view('historical_trends.index', compact(
            'dates',
            'transportationHistory',
            'energyHistory',
            'dietHistory',
            'transportationFootprint',
            'energyFootprint',
            'dietFootprint',
            'totalFootprint',
            'startDate',
            'endDate'
        ));
    }
}
