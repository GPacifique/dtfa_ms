<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Group;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function index()
    {
        $sessions = TrainingSession::with(['coach', 'branch', 'group'])
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->paginate(15);

        return view('admin.sessions.index', compact('sessions'));
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get();
        $groups = Group::orderBy('name')->get();
        // Some environments may not have Spatie roles configured. Fall back safely.
        try {
            $coaches = User::role('coach')->orderBy('name')->get();
        } catch (\Throwable $e) {
            $coaches = User::select('id', 'name')->orderBy('name')->get();
        }

        return view('admin.sessions.create', compact('branches', 'groups', 'coaches'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'location' => ['required', 'string', 'max:255'],
            'coach_user_id' => ['required', 'integer', 'exists:users,id'],
            'branch_id' => ['required', 'integer', 'exists:branches,id'],
            'group_id' => ['required', 'integer', 'exists:groups,id'],
        ]);

        // Ensure the group belongs to the branch
        $group = Group::where('id', $data['group_id'])
            ->where('branch_id', $data['branch_id'])
            ->firstOrFail();

        TrainingSession::create([
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'location' => $data['location'],
            'coach_user_id' => $data['coach_user_id'],
            'branch_id' => $data['branch_id'],
            'group_id' => $group->id,
            'group_name' => $group->name,
        ]);

        return redirect()->route('admin.sessions.index')->with('status', 'Session created.');
    }

    public function edit(TrainingSession $session)
    {
        $branches = Branch::orderBy('name')->get();
        $groups = Group::orderBy('name')->get();
        try {
            $coaches = User::role('coach')->orderBy('name')->get();
        } catch (\Throwable $e) {
            $coaches = User::select('id', 'name')->orderBy('name')->get();
        }

        return view('admin.sessions.edit', compact('session', 'branches', 'groups', 'coaches'));
    }

    public function update(Request $request, TrainingSession $session)
    {
        $data = $request->validate([
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'location' => ['required', 'string', 'max:255'],
            'coach_user_id' => ['required', 'integer', 'exists:users,id'],
            'branch_id' => ['required', 'integer', 'exists:branches,id'],
            'group_id' => ['required', 'integer', 'exists:groups,id'],
        ]);

        $group = Group::where('id', $data['group_id'])
            ->where('branch_id', $data['branch_id'])
            ->firstOrFail();

        $session->update([
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'location' => $data['location'],
            'coach_user_id' => $data['coach_user_id'],
            'branch_id' => $data['branch_id'],
            'group_id' => $group->id,
            'group_name' => $group->name,
        ]);

        return redirect()->route('admin.sessions.index')->with('status', 'Session updated.');
    }

    public function destroy(TrainingSession $session)
    {
        // Clean up related attendance records to avoid orphans
        \App\Models\StudentAttendance::where('training_session_id', $session->id)->delete();
        \App\Models\CoachAttendance::where('training_session_id', $session->id)->delete();
        $session->delete();

        return redirect()->route('admin.sessions.index')->with('status', 'Session deleted.');
    }

    /**
     * Mark attendance for every student in the session's branch+group as present.
     * This is a convenience admin action for quickly recording attendance for all.
     */
    public function recordAllAttendance(TrainingSession $session)
    {
        $students = \App\Models\Student::where('branch_id', $session->branch_id)
            ->where('group_id', $session->group_id)
            ->pluck('id')
            ->all();

        if (empty($students)) {
            return redirect()->route('admin.sessions.index')->with('status', 'No students found for this session.');
        }

        \DB::transaction(function () use ($students, $session) {
            foreach ($students as $sid) {
                \App\Models\StudentAttendance::updateOrCreate(
                    ['student_id' => $sid, 'training_session_id' => $session->id],
                    ['status' => 'present']
                );
            }
            // Mark coach attendance present if a coach was assigned
            if ($session->coach_user_id) {
                \App\Models\CoachAttendance::updateOrCreate(
                    ['coach_user_id' => $session->coach_user_id, 'training_session_id' => $session->id],
                    ['status' => 'present']
                );
            }
        });

        return redirect()->route('admin.sessions.index')->with('status', 'Recorded attendance for all students as present.');
    }
}
