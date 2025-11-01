<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\TrainingSession;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    /**
     * Display a listing of the coach's training sessions.
     */
    public function index()
    {
        $coach = Auth::user();
        $sessions = TrainingSession::where('coach_user_id', $coach->id)
            ->with(['group', 'branch'])
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->paginate(15);

        return view('coach.sessions.index', compact('sessions'));
    }

    /**
     * Show the form for creating a new training session.
     */
    public function create()
    {
        $coach = Auth::user();
        $groups = Group::where('branch_id', $coach->branch_id)->orderBy('name')->get();

        if ($groups->isEmpty()) {
            return redirect()->route('coach.dashboard')
                ->with('error', 'There are no groups in your branch. Please contact an administrator.');
        }

        return view('coach.sessions.create', [
            'groups' => $groups,
            'branch' => $coach->branch,
        ]);
    }

    /**
     * Store a newly created training session in storage.
     */
    public function store(Request $request)
    {
        $coach = Auth::user();
        $data = $request->validate([
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'location' => ['required', 'string', 'max:255'],
            'group_id' => ['required', 'integer', 'exists:groups,id'],
        ]);

        $group = Group::where('id', $data['group_id'])
            ->where('branch_id', $coach->branch_id)
            ->firstOrFail();

        $session = TrainingSession::create([
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'location' => $data['location'],
            'coach_user_id' => $coach->id,
            'branch_id' => $coach->branch_id,
            'group_id' => $group->id,
            'group_name' => $group->name,
        ]);

        // Pre-populate attendance records for the session
        foreach ($group->students as $student) {
            StudentAttendance::create([
                'student_id' => $student->id,
                'training_session_id' => $session->id,
                'status' => 'absent', // Default status
            ]);
        }

        return redirect()->route('coach.sessions.index')->with('status', 'Session created successfully.');
    }

    /**
     * Display the specified training session.
     */
    public function show(TrainingSession $session)
    {
        abort_unless($session->coach_user_id === Auth::id(), 403);
        $session->load(['group', 'branch', 'studentAttendances.student']);

        return view('coach.sessions.show', compact('session'));
    }

    /**
     * Show the form for editing the specified training session.
     */
    public function edit(TrainingSession $session)
    {
        abort_unless($session->coach_user_id === Auth::id(), 403);
        $coach = Auth::user();
        $groups = Group::where('branch_id', $coach->branch_id)->orderBy('name')->get();

        return view('coach.sessions.edit', [
            'session' => $session,
            'groups' => $groups,
            'branch' => $coach->branch,
        ]);
    }

    /**
     * Update the specified training session in storage.
     */
    public function update(Request $request, TrainingSession $session)
    {
        abort_unless($session->coach_user_id === Auth::id(), 403);
        $coach = Auth::user();
        $data = $request->validate([
            'date' => ['required', 'date'],
            'start_time' => ['required'],
            'end_time' => ['required', 'after:start_time'],
            'location' => ['required', 'string', 'max:255'],
            'group_id' => ['required', 'integer', 'exists:groups,id'],
        ]);

        $group = Group::where('id', $data['group_id'])
            ->where('branch_id', $coach->branch_id)
            ->firstOrFail();
            
        $session->update([
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'location' => $data['location'],
            'group_id' => $group->id,
            'group_name' => $group->name,
        ]);

        return redirect()->route('coach.sessions.show', $session)->with('status', 'Session updated successfully.');
    }

    /**
     * Remove the specified training session from storage.
     */
    public function destroy(TrainingSession $session)
    {
        abort_unless($session->coach_user_id === Auth::id(), 403);
        $session->delete();

        return redirect()->route('coach.sessions.index')->with('status', 'Session deleted successfully.');
    }
}
