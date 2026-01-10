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

    public function prepare(TrainingSessionRecord $trainingSessionRecord = null)
    {
        $sessions = TrainingSession::orderBy('date', 'desc')->get(['id','date','location','group_name']);
        $branches = $sessions->pluck('location')->filter()->unique()->values();
        $pitches = ['IPRC Kicukiro- Football', 'Green Hills Academy', 'Star School -Masaka', 'Nyamagana Stadium', 'IPRC-Kigali -Basketball'];

        $coaches = User::role('coach')->get(['id', 'name']);

        return view('admin.training_session_records.prepare', compact('trainingSessionRecord', 'sessions', 'branches', 'pitches', 'coaches'));
    }

    public function report(TrainingSessionRecord $trainingSessionRecord)
    {
        return view('admin.training_session_records.report', compact('trainingSessionRecord'));
    }

    public function index()
    {
        $query = TrainingSessionRecord::query();

        // Filter by status
        if ($status = request()->query('status')) {
            $query->where('status', $status);
        }

        // filters: branch, training_pitch, coach_id, date
        if ($branch = request()->query('branch')) {
            $query->where('branch', $branch);
        }

        if ($pitch = request()->query('training_pitch')) {
            $query->where('training_pitch', $pitch);
        }

        if ($coachId = request()->query('coach_id')) {
            $query->where('coach_id', $coachId)->orWhere('coach_name', function($q) use ($coachId) {
                // if coach name stored, nothing to do here — keep for future enhancement
            });
        }

        if ($date = request()->query('date')) {
            $query->whereDate('date', $date);
        }

        $records = $query->orderBy('date', 'desc')->paginate(15)->withQueryString();

        // prepare filter lists
        $sessions = TrainingSession::orderBy('date', 'desc')->get(['id','date','location','group_name']);
        $branches = $sessions->pluck('location')->filter()->unique()->values();
        $pitches = $sessions->pluck('group_name')->filter()->unique()->values();

        $coaches = [];
        try {
            $coaches = User::role('coach')->select('id','name')->orderBy('name')->get();
        } catch (\Throwable $e) {
            $coaches = User::select('id','name')->orderBy('name')->get();
        }

        return view('admin.training_session_records.index', compact('records', 'branches', 'pitches', 'coaches'));
    }

    public function create()
    {
        $sessions = TrainingSession::orderBy('date', 'desc')->get(['id','date','location','group_name']);
        $branches = $sessions->pluck('location')->filter()->unique()->values();
        $pitches = ['IPRC Kicukiro- Football', 'Green Hills Academy', 'Star School -Masaka', 'Nyamagana Stadium', 'IPRC-Kigali -Basketball'];
        $coaches = User::role('coach')->get(['id', 'name']);

        return view('admin.training_session_records.create', compact('sessions', 'branches', 'pitches', 'coaches'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'status' => 'nullable|in:scheduled,in_progress,completed',
            'date' => 'nullable|date',
            'training_days' => ['nullable', 'array'],
            'training_days.*' => ['in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'],
            'start_time' => 'nullable',
            'finish_time' => 'nullable',
            'country' => 'nullable|string|in:Rwanda,Tanzania',
            'city' => 'nullable|string|in:Kigali,Mwanza',
            'sport_discipline' => 'nullable|string|in:Football,Basketball',
            'coach_name' => 'nullable|string|max:191',
            'coach_id' => 'nullable|exists:users,id',
            'lead_coach_id' => 'nullable|exists:users,id',
            'support_staff' => 'nullable|array',
            'branch' => 'nullable|string|max:191',
            'training_pitch' => 'nullable|string|max:191',
            'other_training_pitch' => 'nullable|string|max:255',
            'training_objective' => 'nullable|string',
            'main_topic' => 'nullable|string|max:191',
            'area_performance' => 'nullable|string|in:Physical,Technical,Tactical,Mental',
            'part1_activities' => 'nullable|string',
            'part1_a1_desc' => 'nullable|string|max:1000',
            'part1_a1_time' => 'nullable|string|max:16',
            'part1_a2_desc' => 'nullable|string|max:1000',
            'part1_a2_time' => 'nullable|string|max:16',
            'part1_a3_desc' => 'nullable|string|max:1000',
            'part1_a3_time' => 'nullable|string|max:16',
            'part2_activities' => 'nullable|string',
            'part2_a1_desc' => 'nullable|string|max:1000',
            'part2_a1_time' => 'nullable|string|max:16',
            'part2_a2_desc' => 'nullable|string|max:1000',
            'part2_a2_time' => 'nullable|string|max:16',
            'part2_a3_desc' => 'nullable|string|max:1000',
            'part2_a3_time' => 'nullable|string|max:16',
            'part3_notes' => 'nullable|string',
            'part3_a1_desc' => 'nullable|string|max:1000',
            'part3_a1_time' => 'nullable|string|max:16',
            'part3_a2_desc' => 'nullable|string|max:1000',
            'part3_a2_time' => 'nullable|string|max:16',
            'part4_message' => 'nullable|string',
            'number_of_kids' => 'nullable|integer',
            'incident_report' => 'nullable|string',
            'missed_damaged_equipment' => 'nullable|string',
            'comments' => 'nullable|string',
        ]);

        // If coach_id provided, populate coach_name for convenience
        if (!empty($data['coach_id'])) {
            $coach = User::find($data['coach_id']);
            if ($coach) {
                $data['coach_name'] = $coach->name;
            }
        }

        $data['training_days'] = $data['training_days'] ?? [];
        TrainingSessionRecord::create($data);

        return redirect()->route('admin.training_session_records.index')->with('success', 'Training session record created.');
    }

    public function show(TrainingSessionRecord $trainingSessionRecord)
    {
        return view('admin.training_session_records.show', compact('trainingSessionRecord'));
    }

    public function edit(TrainingSessionRecord $trainingSessionRecord)
    {
        // Smart routing: if session has attendance/comments data, go to report view
        // Otherwise, go to prepare view for planning
        if ($trainingSessionRecord->number_of_kids || $trainingSessionRecord->incident_report || $trainingSessionRecord->comments) {
            return $this->report($trainingSessionRecord);
        }

        return $this->prepare($trainingSessionRecord);
        $branches = $sessions->pluck('location')->filter()->unique()->values();
        $pitches = $sessions->pluck('group_name')->filter()->unique()->values();

        return view('admin.training_session_records.edit', compact('trainingSessionRecord', 'coaches', 'sessions', 'branches', 'pitches'));
    }

    public function update(Request $request, TrainingSessionRecord $trainingSessionRecord)
    {
        $data = $request->validate([
            'status' => 'nullable|in:scheduled,in_progress,completed',
            'date' => 'nullable|date',
            'training_days' => ['nullable', 'array'],
            'training_days.*' => ['in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday'],
            'start_time' => 'nullable',
            'finish_time' => 'nullable',
              'country' => 'nullable|string|in:Rwanda,Tanzania',
              'city' => 'nullable|string|in:Kigali,Mwanza',
              'sport_discipline' => 'nullable|string|in:Football,Basketball',
            'coach_name' => 'nullable|string|max:191',
            'coach_id' => 'nullable|exists:users,id',
            'lead_coach_id' => 'nullable|exists:users,id',
            'support_staff' => 'nullable|array',
            'branch' => 'nullable|string|max:191',
              'training_pitch' => 'nullable|string|max:191',
              'other_training_pitch' => 'nullable|string|max:255',
              'training_objective' => 'nullable|string',
            'main_topic' => 'nullable|string|max:191',
              'area_performance' => 'nullable|string|in:Physical,Technical,Tactical,Mental',
                        'part1_activities' => 'nullable|string',
                        'part1_a1_desc' => 'nullable|string|max:1000',
                        'part1_a1_time' => 'nullable|string|max:16',
                        'part1_a2_desc' => 'nullable|string|max:1000',
                        'part1_a2_time' => 'nullable|string|max:16',
                        'part1_a3_desc' => 'nullable|string|max:1000',
                        'part1_a3_time' => 'nullable|string|max:16',
                        'part2_activities' => 'nullable|string',
                        'part2_a1_desc' => 'nullable|string|max:1000',
                        'part2_a1_time' => 'nullable|string|max:16',
                        'part2_a2_desc' => 'nullable|string|max:1000',
                        'part2_a2_time' => 'nullable|string|max:16',
                        'part2_a3_desc' => 'nullable|string|max:1000',
                        'part2_a3_time' => 'nullable|string|max:16',
            'part3_notes' => 'nullable|string',
            'part3_a1_desc' => 'nullable|string|max:1000',
            'part3_a1_time' => 'nullable|string|max:16',
            'part3_a2_desc' => 'nullable|string|max:1000',
            'part3_a2_time' => 'nullable|string|max:16',
            'part4_message' => 'nullable|string',
            'number_of_kids' => 'nullable|integer',
            'incident_report' => 'nullable|string',
            'missed_damaged_equipment' => 'nullable|string',
                        'comments' => 'nullable|string',
        ]);

        if (!empty($data['coach_id'])) {
            $coach = User::find($data['coach_id']);
            if ($coach) {
                $data['coach_name'] = $coach->name;
            }
        }

        $data['training_days'] = $data['training_days'] ?? [];
        $trainingSessionRecord->update($data);

        return redirect()->route('admin.training_session_records.show', $trainingSessionRecord)->with('success', 'Training session record updated.');
    }

    public function destroy(TrainingSessionRecord $trainingSessionRecord)
    {
        $trainingSessionRecord->delete();
        return redirect()->route('admin.training_session_records.index')->with('success', 'Record deleted.');
    }

    /**
     * Start a training session (change status to in_progress)
     */
    public function start(TrainingSessionRecord $trainingSessionRecord)
    {
        if ($trainingSessionRecord->status !== 'scheduled') {
            return redirect()->back()->with('error', 'Session has already started or is completed.');
        }

        $trainingSessionRecord->update(['status' => 'in_progress']);

        return redirect()->route('admin.training_session_records.index')
            ->with('success', 'Training session started. You can now report on it.');
    }

    /**
     * Complete a training session (change status to completed)
     */
    public function complete(TrainingSessionRecord $trainingSessionRecord)
    {
        if ($trainingSessionRecord->status === 'completed') {
            return redirect()->back()->with('error', 'Session is already completed.');
        }

        $trainingSessionRecord->update(['status' => 'completed']);

        return redirect()->route('admin.training_session_records.show', $trainingSessionRecord)
            ->with('success', 'Training session marked as completed.');
    }
}
