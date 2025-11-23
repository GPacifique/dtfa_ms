<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StaffAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class StaffAttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:admin|super-admin|coach');
    }

    public function index()
    {
        $records = StaffAttendance::with('staff')->orderBy('date', 'desc')->paginate(20);
        return view('admin.staff_attendances.index', compact('records'));
    }

    public function create()
    {
        $staff = User::orderBy('name')->get();
        return view('admin.staff_attendances.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'staff_id' => 'nullable|exists:users,id',
            'activity_type' => ['required', 'string', 'in:' . implode(',', \App\Models\StaffAttendance::activityKeys())],
            'date' => 'required|date',
            'status' => ['required', 'string', 'in:' . implode(',', \App\Models\StaffAttendance::statusKeys())],
            'notes' => 'nullable|string',
        ]);

        StaffAttendance::create($data);

        return redirect()->route('admin.staff_attendances.index')->with('success', 'Attendance saved.');
    }

    public function show(StaffAttendance $staffAttendance)
    {
        return view('admin.staff_attendances.show', ['attendance' => $staffAttendance]);
    }

    public function edit(StaffAttendance $staffAttendance)
    {
        $staff = User::orderBy('name')->get();
        return view('admin.staff_attendances.edit', compact('staff', 'staffAttendance'));
    }

    public function update(Request $request, StaffAttendance $staffAttendance)
    {
        $data = $request->validate([
            'staff_id' => 'nullable|exists:users,id',
            'activity_type' => ['required', 'string', 'in:' . implode(',', \App\Models\StaffAttendance::activityKeys())],
            'date' => 'required|date',
            'status' => ['required', 'string', 'in:' . implode(',', \App\Models\StaffAttendance::statusKeys())],
            'notes' => 'nullable|string',
        ]);

        $staffAttendance->update($data);

        return redirect()->route('admin.staff_attendances.show', $staffAttendance)->with('success', 'Attendance updated.');
    }

    public function destroy(StaffAttendance $staffAttendance)
    {
        $staffAttendance->delete();
        return redirect()->route('admin.staff_attendances.index')->with('success', 'Record deleted.');
    }
}
