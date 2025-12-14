<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\TrainingSessionRecord;
use App\Models\StudentAttendance;
use App\Http\Requests\StoreStudentAttendanceRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Children linked to this user (parent)
        $children = Student::where('id', $user->id)->get();

        // For simplicity show upcoming sessions for the next 7 days
        $upcoming = TrainingSession::whereDate('date', '>=', now()->toDateString())
            ->whereDate('date', '<=', now()->addDays(7)->toDateString())
            ->orderBy('date')
            ->orderBy('start_time')
            ->get();

        return view('coach.students.index', compact('children', 'upcoming'));
    }

    public function store(StoreStudentAttendanceRequest $request)
    {
        $user = Auth::user();
        $validated = $request->validated();
        $student = Student::findOrFail($validated['student_id']);
        // Optionally, check if the user is allowed to record attendance for this student
        // Remove or adjust this check as needed for your new access policy
        // if ($student->parent_user_id !== $user->id) {
        //     abort(403, 'You are not allowed to check in this student.');
        // }
        $session = TrainingSessionRecord::findOrFail($validated['training_session_id']);
        StudentAttendance::updateOrCreate(
            [
                'student_id' => $student->id,
                'training_session_id' => $session->id,
            ],
            [
                'status' => $validated['status'] ?? 'present',
                'notes' => $validated['notes'] ?? 'Self check-in by user',
                'recorded_by_user_id' => $user->id,
            ]
        );
        return redirect()->route('students-modern.index')->with('success', 'Attendance recorded successfully!');
    }
}
