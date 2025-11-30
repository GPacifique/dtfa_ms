<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SportsEquipment;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SportsEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SportsEquipment::with('branch');

        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('equipment_type')) {
            $query->where('equipment_type', $request->equipment_type);
        }

        $sports_equipment = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.sports-equipment.index', compact('sports_equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();

        return view('admin.sports-equipment.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'equipment_type' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'available_quantity' => 'required|integer|min:0',
            'condition' => ['required', Rule::in(['excellent', 'good', 'fair', 'poor', 'damaged'])],
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'replacement_cost' => 'nullable|numeric|min:0',
            'location' => 'required|string|max:255',
            'storage_area' => 'nullable|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'status' => ['required', Rule::in(['available', 'in_use', 'maintenance', 'retired', 'lost'])],
            'maintenance_date' => 'nullable|date',
            'maintenance_notes' => 'nullable|string',
            'supplier' => 'nullable|string|max:255',
            'reference_code' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        SportsEquipment::create($validated);

        return redirect()->route('admin.sports-equipment.index')
            ->with('success', 'Sports equipment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(SportsEquipment $sports_equipment)
    {
        return view('admin.sports-equipment.show', compact('sports_equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SportsEquipment $sports_equipment)
    {
        $branches = Branch::all();

        return view('admin.sports-equipment.edit', compact('sports_equipment', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SportsEquipment $sports_equipment)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'equipment_type' => 'required|string|max:100',
            'quantity' => 'required|integer|min:1',
            'available_quantity' => 'required|integer|min:0',
            'condition' => ['required', Rule::in(['excellent', 'good', 'fair', 'poor', 'damaged'])],
            'purchase_price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'replacement_cost' => 'nullable|numeric|min:0',
            'location' => 'required|string|max:255',
            'storage_area' => 'nullable|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'status' => ['required', Rule::in(['available', 'in_use', 'maintenance', 'retired', 'lost'])],
            'maintenance_date' => 'nullable|date',
            'maintenance_notes' => 'nullable|string',
            'supplier' => 'nullable|string|max:255',
            'reference_code' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $sports_equipment->update($validated);

        return redirect()->route('admin.sports-equipment.show', $sports_equipment)
            ->with('success', 'Sports equipment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SportsEquipment $sports_equipment)
    {
        $sports_equipment->delete();

        return redirect()->route('admin.sports-equipment.index')
            ->with('success', 'Sports equipment deleted successfully!');
    }
}
