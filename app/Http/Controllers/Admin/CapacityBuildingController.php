<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CapacityBuilding;
use App\Models\Branch;
use App\Models\Role;
use Illuminate\Http\Request;

class CapacityBuildingController extends Controller
{
    public function index()
    {
        $trainings = CapacityBuilding::latest()->paginate(10);

        return view('capacity_buildings.index', compact('trainings'));
    }

    public function create()
    {
        $branches = Branch::all();
        $roles = Role::all();

        return view('capacity_buildings.create', compact('branches', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name'     => 'required|string',
            'second_name'    => 'nullable|string',
            'gender'         => 'nullable|string',
            'country'        => 'required|string',
            'city'           => 'required|string',
            'discipline'     => 'required|string',
            'branch_id'      => 'required|exists:branches,id',
            'role_id'        => 'required|exists:roles,id',
            'training_name'  => 'nullable|string',
            'start'          => 'nullable|date',
            'end'            => 'nullable|date',
        ]);

        CapacityBuilding::create($request->all());

        return redirect()
            ->route('capacity_buildings.index')
            ->with('success', 'Training created successfully.');
    }

    public function show(CapacityBuilding $capacity_building)
    {
        return view('capacity_buildings.show', [
            'training' => $capacity_building
        ]);
    }

    public function edit(CapacityBuilding $capacity_building)
    {
        $branches = Branch::all();
        $roles = Role::all();

        return view('capacity_buildings.edit', [
            'training'  => $capacity_building,
            'branches'  => $branches,
            'roles'     => $roles,
        ]);
    }

    public function update(Request $request, CapacityBuilding $capacity_building)
    {
        $capacity_building->update($request->all());

        return redirect()
            ->route('capacity_buildings.index')
            ->with('success', 'Training updated successfully.');
    }

    public function destroy(CapacityBuilding $capacity_building)
    {
        $capacity_building->delete();

        return redirect()
            ->route('capacity_buildings.index')
            ->with('success', 'Training deleted successfully.');
    }
}
