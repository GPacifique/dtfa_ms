<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentAttendance;
use App\Models\Student;
use App\Models\TrainingSessionRecord;
use App\Models\Branch;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentAttendanceController extends Controller
{
    public function index(Request $request)
    {
        $query = StudentAttendance::with(['student', 'session']);

        // Filter by student
        if ($request->filled('student_id')) {
            $query->where('student_id', $request->student_id);
        }

        // Filter by training session
        if ($request->filled('training_session_id')) {
            $query->where('training_session_id', $request->training_session_id);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by date range
        if ($request->filled('date_from')) {
            $query->whereHas('session', function($q) use ($request) {
                $q->where('date', '>=', $request->date_from);
            });
        }

        if ($request->filled('date_to')) {
            $query->whereHas('session', function($q) use ($request) {
                $q->where('date', '<=', $request->date_to);
            });
        }

        // Filter by branch (string field in training_session_records)
        if ($request->filled('branch')) {
            $query->whereHas('session', function($q) use ($request) {
                $q->where('branch', $request->branch);
            });
        }

        // Filter by discipline
        if ($request->filled('discipline')) {
            $query->whereHas('session', function($q) use ($request) {
                $q->where('sport_discipline', $request->discipline);
            });
        }

        $attendances = $query->orderByDesc('created_at')->paginate(20);

        // Get data for filters
        $students = Student::orderBy('first_name')->get(['id', 'first_name', 'second_name']);
        $sessions = TrainingSessionRecord::orderByDesc('date')->limit(50)->get(['id', 'date', 'start_time', 'branch', 'city']);

        // Get unique branches and disciplines from training_session_records for filters
        $branches = TrainingSessionRecord::distinct()->pluck('branch')->filter()->sort()->values();
        $disciplines = TrainingSessionRecord::distinct()->pluck('sport_discipline')->filter()->sort()->values();

        return view('admin.student-attendance.index', compact('attendances', 'students', 'sessions', 'branches', 'disciplines'));
    }

    public function create()
    {
        $students = Student::where('status', 'active')->orderBy('first_name')->get(['id', 'first_name', 'second_name']);
        $sessions = TrainingSessionRecord::where('date', '>=', now()->subDays(30))
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->get();

        return view('admin.student-attendance.create', compact('students', 'sessions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'training_session_id' => 'required|exists:training_session_records,id',
            'status' => 'required|in:present,absent,late,excused',
            'notes' => 'nullable|string|max:1000',
        ]);

        $validated['recorded_by_user_id'] = Auth::id();

        $attendance = StudentAttendance::create($validated);

        // If coming from student profile, redirect back there
        if ($request->has('redirect_to_student')) {
            return redirect()
                ->route('students-modern.show', $attendance->student_id)
                ->with('attendance_success', 'Attendance recorded successfully!');
        }

        return redirect()
            ->route('admin.student-attendance.index')
            ->with('success', 'Student attendance record created successfully.');
    }

    public function show(StudentAttendance $studentAttendance)
    {
        $studentAttendance->load(['student', 'session.branch', 'session.group', 'session.coach', 'recordedBy']);

        return view('admin.student-attendance.show', compact('studentAttendance'));
    }

    public function edit(StudentAttendance $studentAttendance)
    {
        $students = Student::orderBy('first_name')->get(['id', 'first_name', 'second_name']);
        $sessions = TrainingSessionRecord::where('date', '>=', now()->subDays(60))
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->get();

        return view('admin.student-attendance.edit', compact('studentAttendance', 'students', 'sessions'));
    }

    public function update(Request $request, StudentAttendance $studentAttendance)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'training_session_id' => 'required|exists:training_session_records,id',
            'status' => 'required|in:present,absent,late,excused',
            'notes' => 'nullable|string|max:1000',
        ]);

        $studentAttendance->update($validated);

        return redirect()
            ->route('admin.student-attendance.index')
            ->with('success', 'Student attendance record updated successfully.');
    }

    public function destroy(StudentAttendance $studentAttendance)
    {
        $studentAttendance->delete();

        return redirect()
            ->route('admin.student-attendance.index')
            ->with('success', 'Student attendance record deleted successfully.');
    }

    public function bulkCreate()
    {
        $sessions = TrainingSession::where('date', '>=', now()->subDays(7))
            ->orderByDesc('date')
            ->orderByDesc('start_time')
            ->with(['branch', 'group', 'coach'])
            ->get();

        return view('admin.student-attendance.bulk-create', compact('sessions'));
    }

    public function bulkStore(Request $request)
    {
        $validated = $request->validate([
            'training_session_id' => 'required|exists:training_session_records,id',
            'attendance' => 'required|array',
            'attendance.*.student_id' => 'required|exists:students,id',
            'attendance.*.status' => 'required|in:present,absent,late,excused',
            'attendance.*.notes' => 'nullable|string|max:500',
        ]);

        $session = TrainingSessionRecord::findOrFail($validated['training_session_id']);
        $recordedById = Auth::id();

        foreach ($validated['attendance'] as $record) {
            StudentAttendance::updateOrCreate(
                [
                    'student_id' => $record['student_id'],
                    'training_session_id' => $session->id,
                ],
                [
                    'status' => $record['status'],
                    'notes' => $record['notes'] ?? null,
                    'recorded_by_user_id' => $recordedById,
                ]
            );
        }

        return redirect()
            ->route('admin.student-attendance.index')
            ->with('success', 'Bulk attendance records saved successfully.');
    }

    public function report(Request $request)
    {
        $dateFrom = $request->input('date_from', now()->startOfMonth()->toDateString());
        $dateTo = $request->input('date_to', now()->endOfMonth()->toDateString());

        $branches = Branch::orderBy('name')->get();
        $groups = Group::orderBy('name')->get();

        // Attendance statistics
        $stats = [
            'total' => StudentAttendance::whereHas('session', function($q) use ($dateFrom, $dateTo) {
                $q->whereBetween('date', [$dateFrom, $dateTo]);
            })->count(),
            'present' => StudentAttendance::where('status', 'present')
                ->whereHas('session', function($q) use ($dateFrom, $dateTo) {
                    $q->whereBetween('date', [$dateFrom, $dateTo]);
                })->count(),
            'absent' => StudentAttendance::where('status', 'absent')
                ->whereHas('session', function($q) use ($dateFrom, $dateTo) {
                    $q->whereBetween('date', [$dateFrom, $dateTo]);
                })->count(),
            'late' => StudentAttendance::where('status', 'late')
                ->whereHas('session', function($q) use ($dateFrom, $dateTo) {
                    $q->whereBetween('date', [$dateFrom, $dateTo]);
                })->count(),
            'excused' => StudentAttendance::where('status', 'excused')
                ->whereHas('session', function($q) use ($dateFrom, $dateTo) {
                    $q->whereBetween('date', [$dateFrom, $dateTo]);
                })->count(),
        ];

        // Top attending students
        $topStudents = Student::withCount([
            'attendances as present_count' => function($q) use ($dateFrom, $dateTo) {
                $q->where('status', 'present')
                    ->whereHas('session', function($query) use ($dateFrom, $dateTo) {
                        $query->whereBetween('date', [$dateFrom, $dateTo]);
                    });
            }
        ])
        ->having('present_count', '>', 0)
        ->orderByDesc('present_count')
        ->limit(10)
        ->get();

        return view('admin.student-attendance.report', compact('stats', 'topStudents', 'dateFrom', 'dateTo', 'branches', 'groups'));
    }
}
