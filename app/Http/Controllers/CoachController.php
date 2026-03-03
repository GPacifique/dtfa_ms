<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\TrainingSessionRecord;
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
        $sessionsToday = TrainingSessionRecord::where('coach_id', $coach->id)
            ->where('date', $today)
            ->orderBy('start_time')
            ->get();

        $allSessions = TrainingSessionRecord::where('coach_id', $coach->id)->get();
        $upcomingSessions = TrainingSessionRecord::where('coach_id', $coach->id)
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
        $students = $studentQuery->with(['parent', 'group', 'branch'])->orderBy('first_name')->orderBy('second_name')->get();
        $activeStudents = $students->where('status', 'active');
        $recentStudents = $studentQuery->clone()->latest()->limit(10)->get();

        // Attendance stats — scoped to the coach's branch via student relationship
        $attendanceBranchScope = fn ($q) => $coach->branch_id
            ? $q->whereHas('student', fn ($sq) => $sq->where('branch_id', $coach->branch_id))
            : $q;

        $attendanceTotal   = $attendanceBranchScope(StudentAttendance::query())->count();
        $attendancePresent = $attendanceBranchScope(StudentAttendance::where('status', 'present'))->count();
        $attendanceRate    = $attendanceTotal > 0 ? round(($attendancePresent / $attendanceTotal) * 100) : 0;

        // Recent attendance records (branch-scoped)
        $recentAttendance = $attendanceBranchScope(StudentAttendance::with(['student']))
            ->latest()
            ->limit(15)
            ->get();

        // Recent Training Records (Fiches d'entraînement)
        $recentTrainingRecords = TrainingSessionRecord::where('coach_id', $coach->id)
            ->latest()
            ->limit(10)
            ->get();

        // Training Records Stats
        $completedRecords = TrainingSessionRecord::where('coach_id', $coach->id)
            ->where('status', 'completed')
            ->count();
        $inProgressRecords = TrainingSessionRecord::where('coach_id', $coach->id)
            ->where('status', 'in_progress')
            ->count();
        $scheduledRecords = TrainingSessionRecord::where('coach_id', $coach->id)
            ->where('status', 'scheduled')
            ->count();
        $totalKidsTrained = TrainingSessionRecord::where('coach_id', $coach->id)
            ->where('status', 'completed')
            ->sum('number_of_kids');

        // Teams count (show all - teams are not branch-specific)
        $teamsCount = Team::count();

        // Games/Matches stats (show all - games are not branch-specific)
        $gamesCount = Game::count();
        $upcomingGames = Game::where('status', 'scheduled')
            ->where('date', '>=', now())
            ->orderBy('date')
            ->limit(5)
            ->get();

        // Equipment stats - filter by coach's branch
        $equipmentQuery = SportsEquipment::query()
            ->when($coach->branch_id, fn($q) => $q->where('branch_id', $coach->branch_id));
        $equipmentCount = $equipmentQuery->count();
        $equipmentGood = $equipmentQuery->clone()->where('condition', 'good')->count();

        // Upcoming Events
        $upcomingEventsCount = UpcomingEvent::where('status', 'upcoming')->count();
        $upcomingEvents = UpcomingEvent::where('status', 'upcoming')
            ->orderBy('date')
            ->limit(5)
            ->get();

        // Activity Plans
        $activityPlansCount = ActivityPlan::count();
        $ongoingPlans = ActivityPlan::where('status', 'ongoing')->count();

        // Recent Communications (scope to branch if the model has branch_id)
        $recentCommunications = Communication::with('sender')
            ->when($coach->branch_id, fn ($q) => $q->where('branch_id', $coach->branch_id))
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
            'recentTrainingRecords' => $recentTrainingRecords,
            'completedRecords' => $completedRecords,
            'inProgressRecords' => $inProgressRecords,
            'scheduledRecords' => $scheduledRecords,
            'totalKidsTrained' => $totalKidsTrained,
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
