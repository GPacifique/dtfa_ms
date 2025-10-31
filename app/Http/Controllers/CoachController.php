<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSession;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    public function index(Request $request)
    {
        $coach = Auth::user();
        $today = now()->toDateString();
        $sessionsToday = \App\Models\TrainingSession::where('coach_user_id', $coach->id)
            ->where('date', $today)
            ->orderBy('start_time')
            ->get();

        $allSessions = \App\Models\TrainingSession::where('coach_user_id', $coach->id)->get();
        $studentQuery = \App\Models\Student::where('branch_id', $coach->branch_id)
            ->where('group_id', $coach->group_id);
        $students = $studentQuery->with(['parent', 'group'])->get();
        $activeStudents = $students->where('status', 'active');

        // Attendance rate: present / total for this coach's sessions
        $sessionIds = $allSessions->pluck('id');
        $attendanceTotal = \App\Models\StudentAttendance::whereIn('training_session_id', $sessionIds)->count();
        $attendancePresent = \App\Models\StudentAttendance::whereIn('training_session_id', $sessionIds)->where('status', 'present')->count();
        $attendanceRate = $attendanceTotal > 0 ? round(($attendancePresent / $attendanceTotal) * 100) : 0;

        return view('coach.dashboard', [
            'sessionsToday' => $sessionsToday,
            'allSessions' => $allSessions,
            'students' => $students,
            'activeStudents' => $activeStudents,
            'attendanceRate' => $attendanceRate,
        ]);
    }
}
