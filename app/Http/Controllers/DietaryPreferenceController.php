<?php

namespace App\Http\Controllers;

use App\Models\DietaryPreferencesModel;
use Illuminate\Http\Request;

class DietaryPreferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [
            'dp' => DietaryPreferencesModel::all()
        ];
        return view('dietary_preference.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dietary_preference.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:dietary_preferences,name',
            'value' => 'required|numeric'
        ]);
        DietaryPreferencesModel::create([
            'name' => $request->name,
            'value' => $request->value
        ]);
        return redirect()->route('dp.index')->with('success', 'Dietary Preference created successfully');
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
            'dp' => DietaryPreferencesModel::find($id)
        ];
        return view('dietary_preference.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'value' => 'required|numeric'
        ]);
        $dp = DietaryPreferencesModel::find($id);
        $dp->name = $request->name;
        $dp->value = $request->value;
        $dp->save();
        return redirect()->route('dp.index')->with('success', 'Dietary Preference updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
