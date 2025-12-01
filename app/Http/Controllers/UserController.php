<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TrainingSession;
use App\Models\StudentAttendance;
use App\Models\Communication;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        $today = now()->toDateString();

        $upcomingQuery = TrainingSession::query();
        if ($user?->group_id) {
            $upcomingQuery->where('group_id', $user->group_id);
        } elseif ($user?->branch_id) {
            $upcomingQuery->where('branch_id', $user->branch_id);
        }
        $upcoming = $upcomingQuery->where('date', '>=', $today)
            ->orderBy('date')->orderBy('start_time')->limit(5)->get();

        $attendanceRate = 0;
        if ($user?->group_id) {
            $sessionIds = TrainingSession::where('group_id', $user->group_id)->pluck('id');
            $total = StudentAttendance::whereIn('training_session_id', $sessionIds)->count();
            $present = StudentAttendance::whereIn('training_session_id', $sessionIds)->where('status', 'present')->count();
            $attendanceRate = $total > 0 ? round(($present / $total) * 100) : 0;
        }

        $recentCommunications = Communication::latest('created_at')->limit(5)->get();

        return view('user.dashboard', [
            'upcomingSessions' => $upcoming,
            'upcomingSessionsCount' => $upcoming->count(),
            'myAttendanceRate' => $attendanceRate,
            'recentCommunications' => $recentCommunications,
        ]);
    }
}
