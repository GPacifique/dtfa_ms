<?php

namespace App\Http\Controllers\Coach;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;


class StudentsController extends Controller {

    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
        $this->middleware('auth');
    }

    public function create()
    {
        $coach = Auth::user();
        // Only show coaches from the same branch
        $coaches = User::role('coach')
            ->when($coach->branch_id, fn($q) => $q->where('branch_id', $coach->branch_id))
            ->orderBy('name')
            ->get(['id','name','email']);
        return view('coach.students.create', compact('coaches'));
    }

    public function store(Request $request)
    {
        $coach = Auth::user();
        $this->studentService->createForCoach($request, $coach);
        return redirect()->route('coach.students.index')->with('status', 'Student created successfully.');
    }

    public function edit(Student $student)
    {
        $coach = Auth::user();
        // Only show coaches from the same branch
        $coaches = User::role('coach')
            ->when($coach->branch_id, fn($q) => $q->where('branch_id', $coach->branch_id))
            ->orderBy('name')
            ->get(['id','name','email']);
        return view('coach.students.edit', compact('student','coaches'));
    }

    public function update(Request $request, Student $student)
    {
        $this->studentService->updateFromRequest($student, $request);
        return redirect()->route('coach.students.show', $student)->with('status', 'Student updated successfully.');
    }
    public function index(Request $request)
    {
        $coach = Auth::user();
        $q = trim((string) $request->get('q'));

        $students = Student::with(['parent', 'group', 'branch'])
            ->when($coach->branch_id, fn($query) => $query->where('branch_id', $coach->branch_id))
            ->when($coach->group_id, fn($query) => $query->where('group_id', $coach->group_id))
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('first_name', 'like', "%$q%")
                        ->orWhere('second_name', 'like', "%$q%")
                        ->orWhere('phone', 'like', "%$q%");
                });
            })
            ->orderBy('first_name')
            ->orderBy('second_name')
            ->paginate(15)
            ->withQueryString();

        return view('coach.students.index', [
            'students' => $students,
            'q' => $q,
        ]);
    }

    public function show(Student $student)
    {
        $student->load(['parent', 'branch', 'group']);

        return view('coach.students.show', compact('student'));
    }

    public function attendance(Student $student)
    {
        // Show all attendance records for this student
        $records = \App\Models\StudentAttendance::query()
            ->where('student_id', $student->id)
            ->join('training_sessions', 'student_attendances.training_session_id', '=', 'training_sessions.id')
            ->orderByDesc('training_sessions.date')
            ->orderByDesc('training_sessions.start_time')
            ->select('student_attendances.*',
                'training_sessions.date as session_date',
                'training_sessions.start_time as session_start',
                'training_sessions.end_time as session_end',
                'training_sessions.location as session_location',
                'training_sessions.group_name as session_group')
            ->paginate(15);

        return view('coach.students.attendance', [
            'student' => $student,
            'records' => $records,
        ]);
    }
}
