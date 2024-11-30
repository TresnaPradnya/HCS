<?php

namespace App\Http\Controllers;

use App\Models\CommutingMethodsModel;
use Illuminate\Http\Request;

class CommutingMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [
            'cm' => CommutingMethodsModel::all(),
        ];
        return view('commuting_method.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('commuting_method.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|unique:commuting_methods',
            'value' => 'required|numeric'
        ]);
        CommutingMethodsModel::create([
            'name' => $request->name,
            'value' => $request->value
        ]);
        return redirect()->route('cm.index')->with('success', 'Commuting Method created successfully');
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
            'cm' => CommutingMethodsModel::find($id)
        ];
        return view('commuting_method.edit', $data);
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
        $cm = CommutingMethodsModel::find($id);
        $cm->name = $request->name;
        $cm->value = $request->value;
        $cm->save();
        return redirect()->route('cm.index')->with('success', 'Commuting Method updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
