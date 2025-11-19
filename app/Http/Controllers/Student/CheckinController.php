<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\TrainingSession;
use App\Models\StudentAttendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Children linked to this user (parent)
        $children = Student::where('parent_user_id', $user->id)->get();

        // For simplicity show upcoming sessions for the next 7 days
        $upcoming = TrainingSession::whereDate('date', '>=', now()->toDateString())
            ->whereDate('date', '<=', now()->addDays(7)->toDateString())
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('student.checkin.index', compact('children', 'upcoming'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'student_id' => ['required', 'integer'],
            'training_session_id' => ['required', 'integer'],
        ]);

        $student = Student::findOrFail($validated['student_id']);

        // Ensure the student belongs to the authenticated parent
        if ($student->parent_user_id !== $user->id) {
            abort(403, 'You are not allowed to check in this student.');
        }

        $session = TrainingSession::findOrFail($validated['training_session_id']);

        // Ensure the session matches student's branch/group
        if ($session->branch_id !== $student->branch_id || $session->group_id !== $student->group_id) {
            abort(403, 'This session is not valid for the selected student.');
        }

        StudentAttendance::updateOrCreate(
            [
                'student_id' => $student->id,
                'training_session_id' => $session->id,
            ],
            [
                'status' => 'present',
                'notes' => 'Self check-in by parent/user',
            ]
        );

        return redirect()->route('student.checkin.index')->with('success', 'Check-in recorded.');
    }
}
