<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = \App\Models\Report::all();
        return view('reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no' => 'required|integer|unique:reports,no',
            'workstream' => 'required|in:SPORTING,BUSINESS,ADMINISTRATION,TECHNOLOGY',
            'activity' => 'required|string',
            'status' => 'required|in:RED,YELLOW,GREEN',
            'comments' => 'nullable|string',
        ]);
        \App\Models\Report::create($validated);
        return redirect()->route('reports.index')->with('success', 'Report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $report = \App\Models\Report::findOrFail($id);
        return view('reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $report = \App\Models\Report::findOrFail($id);
        return view('reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $report = \App\Models\Report::findOrFail($id);
        $validated = $request->validate([
            'no' => 'required|integer|unique:reports,no,' . $report->id,
            'workstream' => 'required|in:SPORTING,BUSINESS,ADMINISTRATION,TECHNOLOGY',
            'activity' => 'required|string',
            'status' => 'required|in:RED,YELLOW,GREEN',
            'comments' => 'nullable|string',
        ]);
        $report->update($validated);
        return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = \App\Models\Report::findOrFail($id);
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
    }
}
