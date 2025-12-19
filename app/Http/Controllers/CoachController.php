<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrainingSession;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\Communication;
use App\Models\Team;
use App\Models\Game;
use App\Models\SportsEquipment;
use App\Models\UpcomingEvent;
use App\Models\ActivityPlan;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    public function index(Request $request)
    {
        $coach = Auth::user();
        $today = now()->toDateString();

        // Sessions
        $sessionsToday = TrainingSession::where('coach_user_id', $coach->id)
            ->where('date', $today)
            ->orderBy('start_time')
            ->get();

        $allSessions = TrainingSession::where('coach_user_id', $coach->id)->get();
        $upcomingSessions = TrainingSession::where('coach_user_id', $coach->id)
            ->where('date', '>=', $today)
            ->orderBy('date')
            ->orderBy('start_time')
            ->limit(5)
            ->get();

        // Students - either by coach's branch/group or all if super coach
        $studentQuery = Student::query();
        if ($coach->branch_id) {
            $studentQuery->where('branch_id', $coach->branch_id);
        }
        if ($coach->group_id) {
            $studentQuery->where('group_id', $coach->group_id);
        }
        $students = $studentQuery->with(['parent', 'group', 'branch'])->get();
        $activeStudents = $students->where('status', 'active');
        $recentStudents = $studentQuery->clone()->latest()->limit(10)->get();

        // Attendance stats
        $sessionIds = $allSessions->pluck('id');
        $attendanceTotal = StudentAttendance::whereIn('training_session_id', $sessionIds)->count();
        $attendancePresent = StudentAttendance::whereIn('training_session_id', $sessionIds)->where('status', 'present')->count();
        $attendanceRate = $attendanceTotal > 0 ? round(($attendancePresent / $attendanceTotal) * 100) : 0;

        // Recent attendance records
        $recentAttendance = StudentAttendance::with(['student'])
            ->whereIn('training_session_id', $sessionIds)
            ->latest()
            ->limit(15)
            ->get();

        // Teams count
        $teamsCount = Team::count();

        // Games/Matches stats
        $gamesCount = Game::count();
        $upcomingGames = Game::where('status', 'scheduled')
            ->where('match_date', '>=', now())
            ->orderBy('match_date')
            ->limit(5)
            ->get();

        // Equipment stats
        $equipmentCount = SportsEquipment::count();
        $equipmentGood = SportsEquipment::where('condition', 'good')->count();

        // Upcoming Events
        $upcomingEventsCount = UpcomingEvent::where('status', 'upcoming')->count();
        $upcomingEvents = UpcomingEvent::where('status', 'upcoming')
            ->orderBy('event_date')
            ->limit(5)
            ->get();

        // Activity Plans
        $activityPlansCount = ActivityPlan::count();
        $ongoingPlans = ActivityPlan::where('status', 'ongoing')->count();

        // Recent Communications
        $recentCommunications = Communication::with('sender')
            ->latest('sent_at')
            ->limit(10)
            ->get();

        return view('coach.dashboard', [
            'sessionsToday' => $sessionsToday,
            'allSessions' => $allSessions,
            'upcomingSessions' => $upcomingSessions,
            'students' => $students,
            'activeStudents' => $activeStudents,
            'recentStudents' => $recentStudents,
            'attendanceRate' => $attendanceRate,
            'recentAttendance' => $recentAttendance,
            'teamsCount' => $teamsCount,
            'gamesCount' => $gamesCount,
            'upcomingGames' => $upcomingGames,
            'equipmentCount' => $equipmentCount,
            'equipmentGood' => $equipmentGood,
            'upcomingEventsCount' => $upcomingEventsCount,
            'upcomingEvents' => $upcomingEvents,
            'activityPlansCount' => $activityPlansCount,
            'ongoingPlans' => $ongoingPlans,
            'recentCommunications' => $recentCommunications,
        ]);
    }
}
