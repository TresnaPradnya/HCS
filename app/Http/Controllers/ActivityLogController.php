<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Models\EnergySourceModel;
use Illuminate\Routing\Controller;
use App\Models\CommutingMethodsModel;
use App\Models\DietaryPreferencesModel;
use Illuminate\Support\Facades\Auth;

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
        //
        $request->validate([
            'commuting_method_id' => 'required|exists:commuting_methods,id',
            'energy_source_id' => 'required|exists:energy_sources,id',
            'dietary_preference_id' => 'required|exists:dietary_preferences,id',
            'date' => 'required|date',
            'commuting_method_value' => 'required|numeric',
            'energy_source_value' => 'required|numeric'
        ]);
        ActivityLog::create([
            'user_id' =>Auth::id(),
            'commuting_method_id' => $request->commuting_method_id,
            'energy_source_id' => $request->energy_source_id,
            'dietary_preference_id' => $request->dietary_preference_id,
            'date' => $request->date,
            'commuting_method_value' => $request->commuting_method_value,
            'dietary_preference_value' => 1,
            'energy_source_value' => $request->energy_source_value
        ]);
        return redirect()->route('al.index')->with([
            'success' => 'Activity log created successfully'
        ]);
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
        //
        $request->validate([
            'commuting_method_id' => 'required|exists:commuting_methods,id',
            'energy_source_id' => 'required|exists:energy_sources,id',
            'dietary_preference_id' => 'required|exists:dietary_preferences,id',
            'date' => 'required|date',
            'commuting_method_value' => 'required|numeric',
            'energy_source_value' => 'required|numeric'
        ]);
        $al = ActivityLog::find($id);
        $al->commuting_method_id = $request->commuting_method_id;
        $al->energy_source_id = $request->energy_source_id;
        $al->dietary_preference_id = $request->dietary_preference_id;
        $al->date = $request->date;
        $al->commuting_method_value = $request->commuting_method_value;
        $al->dietary_preference_value = 1;
        $al->energy_source_value = $request->energy_source_value;
        $al->save();
        return redirect()->route('al.index')->with([
            'success' => 'Activity log updated successfully'
        ]);
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
}
