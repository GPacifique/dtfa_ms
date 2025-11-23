<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CapacityBuilding;

class CapacityBuildingController extends Controller
{
    public function index()
    {
        $items = CapacityBuilding::latest()->paginate(20);
        return view('admin.capacity_buildings.index', compact('items'));
    }

    public function create()
    {
        return view('admin.capacity_buildings.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateRequest($request);
        CapacityBuilding::create($data);
        return redirect()->route('admin.capacity-buildings.index')->with('status', 'Capacity building record created');
    }

    public function show(CapacityBuilding $capacity_building)
    {
        return view('admin.capacity_buildings.show', ['item' => $capacity_building]);
    }

    public function edit(CapacityBuilding $capacity_building)
    {
        return view('admin.capacity_buildings.edit', ['item' => $capacity_building]);
    }

    public function update(Request $request, CapacityBuilding $capacity_building)
    {
        $data = $this->validateRequest($request);
        $capacity_building->update($data);
        return redirect()->route('admin.capacity-buildings.index')->with('status', 'Capacity building record updated');
    }

    public function destroy(CapacityBuilding $capacity_building)
    {
        $capacity_building->delete();
        return redirect()->route('admin.capacity-buildings.index')->with('status', 'Record deleted');
    }

    /**
     * Display summary statistics for capacity building costs.
     */
    public function stats()
    {
        $query = CapacityBuilding::query();

        $count = (int) $query->count();
        $total = (float) CapacityBuilding::sum('cost_amount');
        $average = $count ? (float) CapacityBuilding::avg('cost_amount') : 0.0;
        $min = CapacityBuilding::min('cost_amount');
        $max = CapacityBuilding::max('cost_amount');

        $byCostType = CapacityBuilding::selectRaw('cost_type, COUNT(*) as count, SUM(cost_amount) as total')
            ->groupBy('cost_type')
            ->get()
            ->map(function ($row) {
                return [
                    'cost_type' => $row->cost_type,
                    'count' => (int) $row->count,
                    'total' => (float) $row->total,
                ];
            });

        $byCategory = CapacityBuilding::selectRaw('training_category, COUNT(*) as count, SUM(cost_amount) as total')
            ->groupBy('training_category')
            ->orderByDesc('total')
            ->get();

        return view('admin.capacity_buildings.stats', compact('count','total','average','min','max','byCostType','byCategory'));
    }

    protected function validateRequest(Request $request)
    {
        return $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'nullable|string|max:255',
            'gender' => 'nullable|string|max:50',
            'branch' => 'nullable|string|max:255',
            'role_function' => 'nullable|string|max:255',
            'training_name' => 'required|string|max:255',
            'institution_name' => 'nullable|string|max:255',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'channel' => 'nullable|string|max:100',
            'cost_type' => 'nullable|string|in:free,paid',
            'cost_amount' => 'nullable|numeric|min:0',
            'training_category' => 'nullable|string|max:100',
            'venue' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ]);
    }
}
