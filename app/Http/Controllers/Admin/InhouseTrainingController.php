<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\InhouseTraining;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;   // ← ADD THIS LINE


class InhouseTrainingController extends Controller
{
    public function index()
    {
        $inhousetrainings = InhouseTraining::latest()->paginate(10);
        return view('admin.inhousetrainings.index', compact('inhousetrainings'));
    }

    public function create()
    {
        $branches = Branch::all();
        $roles = Role::all();

        return view('admin.inhousetrainings.create', compact('branches', 'roles'));
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

        InhouseTraining::create($request->all());

        return redirect()->route('admin.inhousetrainings.index')
            ->with('success', 'Training created successfully.');
    }

    public function show(InhouseTraining $inhousetraining)
    {
        return view('admin.inhousetrainings.show', compact('inhousetraining'));
    }

    public function edit(InhouseTraining $inhousetraining)
    {
        $branches = Branch::all();
        $roles = Role::all();

        return view('admin.inhousetrainings.edit', compact('inhousetraining','branches','roles'));
    }

    public function update(Request $request, InhouseTraining $inhousetraining)
    {
        $inhousetraining->update($request->all());
        return redirect()->route('admin.inhousetrainings.index')
            ->with('success', 'Training updated successfully.');
    }

    public function destroy(InhouseTraining $inhousetraining)
    {
        $inhousetraining->delete();
        return redirect()->route('admin.inhousetrainings.index')
            ->with('success', 'Training deleted successfully.');
    }
}
