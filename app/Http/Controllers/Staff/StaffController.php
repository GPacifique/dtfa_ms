<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Staff;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class StaffController extends Controller
{
    public function index()
    {
        $staff = Staff::orderBy('last_name')->paginate(20);
        return view('staff.index', compact('staff'));
    }

    public function create()
    {
        return view('staff.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'branch' => 'nullable|in:RWANDA,TANZANIA',
            'discipline' => 'nullable|in:Football,Basketball',
            'gender' => 'nullable|in:Male,Female',
            'dob' => 'nullable|date',
            'role_function' => 'nullable|string|max:255',
            'date_entry' => 'nullable|date',
            'date_exit' => 'nullable|date',
            'other_organizations' => 'nullable|string',
            'academic_qualification' => 'nullable|string',
            'major' => 'nullable|string|max:255',
            'professional_certificates' => 'nullable|string',
            'tshirt_size' => 'nullable|string|max:50',
            'short_size' => 'nullable|string|max:50',
            'top_tracksuit_size' => 'nullable|string|max:50',
            'pant_tracksuit_size' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255|unique:staff,email',
        ]);

        Staff::create($data);

        return redirect()->route('staff.index')->with('status', 'Staff profile created');
    }

    public function show(Staff $staff)
    {
        return view('staff.show', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        return view('staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'branch' => 'nullable|in:RWANDA,TANZANIA',
            'discipline' => 'nullable|in:Football,Basketball',
            'gender' => 'nullable|in:Male,Female',
            'dob' => 'nullable|date',
            'role_function' => 'nullable|string|max:255',
            'date_entry' => 'nullable|date',
            'date_exit' => 'nullable|date',
            'other_organizations' => 'nullable|string',
            'academic_qualification' => 'nullable|string',
            'major' => 'nullable|string|max:255',
            'professional_certificates' => 'nullable|string',
            'tshirt_size' => 'nullable|string|max:50',
            'short_size' => 'nullable|string|max:50',
            'top_tracksuit_size' => 'nullable|string|max:50',
            'pant_tracksuit_size' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255|unique:staff,email,' . $staff->id,
        ]);

        $staff->update($data);

        return redirect()->route('staff.index')->with('status', 'Staff profile updated');
    }

    public function destroy(Staff $staff)
    {
        $staff->delete();
        return redirect()->route('staff.index')->with('status', 'Staff deleted');
    }
}
