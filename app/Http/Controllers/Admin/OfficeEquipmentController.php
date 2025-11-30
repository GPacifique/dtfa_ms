<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OfficeEquipment;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OfficeEquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = OfficeEquipment::with('branch');

        if ($request->filled('condition')) {
            $query->where('condition', $request->condition);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('equipment_type')) {
            $query->where('equipment_type', $request->equipment_type);
        }

        if ($request->filled('assigned_to')) {
            $query->where('assigned_to', 'like', '%' . $request->assigned_to . '%');
        }

        $office_equipment = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.office-equipment.index', compact('office_equipment'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();

        return view('admin.office-equipment.create', compact('branches'));
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
            'assigned_to' => 'nullable|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'status' => ['required', Rule::in(['available', 'in_use', 'maintenance', 'retired', 'lost'])],
            'maintenance_date' => 'nullable|date',
            'maintenance_notes' => 'nullable|string',
            'warranty_expiry' => 'nullable|date',
            'supplier' => 'nullable|string|max:255',
            'reference_code' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        OfficeEquipment::create($validated);

        return redirect()->route('admin.office-equipment.index')
            ->with('success', 'Office equipment added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(OfficeEquipment $office_equipment)
    {
        return view('admin.office-equipment.show', compact('office_equipment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OfficeEquipment $office_equipment)
    {
        $branches = Branch::all();

        return view('admin.office-equipment.edit', compact('office_equipment', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OfficeEquipment $office_equipment)
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
            'assigned_to' => 'nullable|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'status' => ['required', Rule::in(['available', 'in_use', 'maintenance', 'retired', 'lost'])],
            'maintenance_date' => 'nullable|date',
            'maintenance_notes' => 'nullable|string',
            'warranty_expiry' => 'nullable|date',
            'supplier' => 'nullable|string|max:255',
            'reference_code' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
        ]);

        $office_equipment->update($validated);

        return redirect()->route('admin.office-equipment.show', $office_equipment)
            ->with('success', 'Office equipment updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OfficeEquipment $office_equipment)
    {
        $office_equipment->delete();

        return redirect()->route('admin.office-equipment.index')
            ->with('success', 'Office equipment deleted successfully!');
    }
}
