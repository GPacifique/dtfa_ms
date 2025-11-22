<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TrainingSessionRecord;
use App\Models\TrainingSession;
use App\Models\User;
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
        // fetch coaches and recent training sessions to populate dropdowns
        $coaches = [];
        try {
            $coaches = User::role('coach')->select('id', 'name')->orderBy('name')->get();
        } catch (\Throwable $e) {
            // role helper may not be available in some environments; fallback to empty collection
            $coaches = User::select('id', 'name')->orderBy('name')->get();
        }

        $sessions = TrainingSession::orderBy('date', 'desc')->get(['id','date','location','group_name']);
        $branches = $sessions->pluck('location')->filter()->unique()->values();
        $pitches = $sessions->pluck('group_name')->filter()->unique()->values();

        return view('admin.training_session_records.create', compact('coaches', 'sessions', 'branches', 'pitches'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'nullable|date',
            'start_time' => 'nullable',
            'finish_time' => 'nullable',
            'coach_name' => 'nullable|string|max:191',
            'coach_id' => 'nullable|exists:users,id',
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

        // If coach_id provided, populate coach_name for convenience
        if (!empty($data['coach_id'])) {
            $coach = User::find($data['coach_id']);
            if ($coach) {
                $data['coach_name'] = $coach->name;
            }
        }

        TrainingSessionRecord::create($data);

        return redirect()->route('admin.training_session_records.index')->with('success', 'Training session record created.');
    }

    public function show(TrainingSessionRecord $trainingSessionRecord)
    {
        return view('admin.training_session_records.show', compact('trainingSessionRecord'));
    }

    public function edit(TrainingSessionRecord $trainingSessionRecord)
    {
        // reuse the same lists as create()
        $coaches = [];
        try {
            $coaches = User::role('coach')->select('id', 'name')->orderBy('name')->get();
        } catch (\Throwable $e) {
            $coaches = User::select('id', 'name')->orderBy('name')->get();
        }

        $sessions = TrainingSession::orderBy('date', 'desc')->get(['id','date','location','group_name']);
        $branches = $sessions->pluck('location')->filter()->unique()->values();
        $pitches = $sessions->pluck('group_name')->filter()->unique()->values();

        return view('admin.training_session_records.edit', compact('trainingSessionRecord', 'coaches', 'sessions', 'branches', 'pitches'));
    }

    public function update(Request $request, TrainingSessionRecord $trainingSessionRecord)
    {
        $data = $request->validate([
            'date' => 'nullable|date',
            'start_time' => 'nullable',
            'finish_time' => 'nullable',
            'coach_name' => 'nullable|string|max:191',
            'coach_id' => 'nullable|exists:users,id',
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

        if (!empty($data['coach_id'])) {
            $coach = User::find($data['coach_id']);
            if ($coach) {
                $data['coach_name'] = $coach->name;
            }
        }

        $trainingSessionRecord->update($data);

        return redirect()->route('admin.training_session_records.show', $trainingSessionRecord)->with('success', 'Training session record updated.');
    }

    public function destroy(TrainingSessionRecord $trainingSessionRecord)
    {
        $trainingSessionRecord->delete();
        return redirect()->route('admin.training_session_records.index')->with('success', 'Record deleted.');
    }
}
