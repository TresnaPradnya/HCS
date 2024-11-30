<?php

namespace App\Http\Controllers;

use App\Models\EnergySourceModel;
use Illuminate\Http\Request;

class EnergySourceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [
            'energy_sources' => EnergySourceModel::all(),
        ];
        return view('energy_source.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('energy_source.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:energy_sources',
            'value' => 'required|numeric',
        ]);

        EnergySourceModel::create([
            'name' => $request->name,
            'value' => $request->value,
        ]);

        return redirect()->route('es.index')->with('success', 'Energy source created successfully');
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
            'es' => EnergySourceModel::find($id),
        ];
        return view('energy_source.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'name' => 'required',
            'value' => 'required|numeric',
        ]);
        $es = EnergySourceModel::find($id);
        $es->name = $request->name;
        $es->value = $request->value;
        $es->save();
        return redirect()->route('es.index')->with('success', 'Energy source updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
