<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingSessionRecord;
use Illuminate\Http\Request;

class TrainingSessionRecordController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // Allow admins, super-admins and coaches to access these actions
        $this->middleware('role:admin|super-admin|coach');
    }

    public function index()
    {
        $records = TrainingSessionRecord::orderBy('date', 'desc')->paginate(15);
        return view('admin.training_session_records.index', compact('records'));
    }

    public function create()
    {
        return view('admin.training_session_records.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'nullable|date',
            'start_time' => 'nullable',
            'finish_time' => 'nullable',
            'coach_name' => 'nullable|string|max:191',
            'branch' => 'nullable|string|max:191',
            'training_pitch' => 'nullable|string|max:191',
            'main_topic' => 'nullable|string|max:191',
            'area_performance' => 'nullable|string|max:191',
            'part1_activities' => 'nullable|string',
            'part2_activities' => 'nullable|string',
            'part3_notes' => 'nullable|string',
            'part4_message' => 'nullable|string',
            'number_of_kids' => 'nullable|integer',
            'incident_report' => 'nullable|string',
            'missed_damaged_equipment' => 'nullable|string',
        ]);

        TrainingSessionRecord::create($data);

        return redirect()->route('admin.training_session_records.index')->with('success', 'Training session record created.');
    }

    public function show(TrainingSessionRecord $trainingSessionRecord)
    {
        return view('admin.training_session_records.show', compact('trainingSessionRecord'));
    }

    public function edit(TrainingSessionRecord $trainingSessionRecord)
    {
        return view('admin.training_session_records.edit', compact('trainingSessionRecord'));
    }

    public function update(Request $request, TrainingSessionRecord $trainingSessionRecord)
    {
        $data = $request->validate([
            'date' => 'nullable|date',
            'start_time' => 'nullable',
            'finish_time' => 'nullable',
            'coach_name' => 'nullable|string|max:191',
            'branch' => 'nullable|string|max:191',
            'training_pitch' => 'nullable|string|max:191',
            'main_topic' => 'nullable|string|max:191',
            'area_performance' => 'nullable|string|max:191',
            'part1_activities' => 'nullable|string',
            'part2_activities' => 'nullable|string',
            'part3_notes' => 'nullable|string',
            'part4_message' => 'nullable|string',
            'number_of_kids' => 'nullable|integer',
            'incident_report' => 'nullable|string',
            'missed_damaged_equipment' => 'nullable|string',
        ]);

        $trainingSessionRecord->update($data);

        return redirect()->route('admin.training_session_records.show', $trainingSessionRecord)->with('success', 'Training session record updated.');
    }

    public function destroy(TrainingSessionRecord $trainingSessionRecord)
    {
        $trainingSessionRecord->delete();
        return redirect()->route('admin.training_session_records.index')->with('success', 'Record deleted.');
    }
}
