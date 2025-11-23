<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Group;
use App\Models\TrainingSession;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentAttendance;

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

    public function store(\App\Http\Requests\TrainingSessionRequest $request)
    {
        $data = $request->validated();

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

    public function update(\App\Http\Requests\TrainingSessionRequest $request, TrainingSession $session)
    {
        $this->authorize('update', $session);
        $data = $request->validated();

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
     * Show attendance form for a given session (list students + current statuses).
     */
    public function attendance(TrainingSession $session)
    {
        // load students for this session's branch and group
        $students = Student::where('branch_id', $session->branch_id)
            ->where('group_id', $session->group_id)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        // load existing attendance keyed by student_id
        $existing = StudentAttendance::where('training_session_id', $session->id)
            ->get()
            ->keyBy('student_id');

        return view('admin.sessions.attendance', compact('session', 'students', 'existing'));
    }

    /**
     * Persist attendance submitted from the form.
     */
    public function storeAttendance(Request $request, TrainingSession $session)
    {
        $data = $request->validate([
            'attendances' => 'nullable|array',
            'attendances.*.status' => 'nullable|string|in:present,absent,late,excused',
            'attendances.*.notes' => 'nullable|string',
        ]);

        $att = $data['attendances'] ?? [];

        \DB::transaction(function () use ($att, $session) {
            foreach ($att as $studentId => $row) {
                StudentAttendance::updateOrCreate(
                    ['student_id' => $studentId, 'training_session_id' => $session->id],
                    [
                        'status' => $row['status'] ?? 'present',
                        'notes' => $row['notes'] ?? null,
                    ]
                );
            }
        });

        return redirect()->route('admin.sessions.index')->with('status', 'Attendance saved.');
    }

    /**
     * Export attendance for a session as CSV download.
     */
    public function exportAttendanceCsv(TrainingSession $session)
    {
        $fileName = 'attendance_session_'.$session->id.'_'.now()->format('Ymd_His').'.csv';

        $callback = function () use ($session) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['session_id','date','start_time','end_time','student_id','student_name','status','notes']);

            $rows = \App\Models\StudentAttendance::where('training_session_id', $session->id)
                ->join('students', 'student_attendances.student_id', '=', 'students.id')
                ->select('student_attendances.*', 'students.first_name', 'students.second_name')
                ->orderBy('students.first_name')
                ->get();

            foreach ($rows as $r) {
                fputcsv($handle, [
                    $session->id,
                    optional($session->date)->format('Y-m-d'),
                    $session->start_time,
                    $session->end_time,
                    $r->student_id,
                    $r->first_name.' '.$r->second_name,
                    $r->status,
                    $r->notes,
                ]);
            }
            fclose($handle);
        };

        return new \Symfony\Component\HttpFoundation\StreamedResponse($callback, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$fileName\"",
        ]);
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
