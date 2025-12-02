<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use App\Models\Branch;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\StudentRegistered;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $status = $request->query('status');
        $branchId = $request->query('branch_id');
        $groupId = $request->query('group_id');
        $from = $request->query('from');
        $to = $request->query('to');

        $students = Student::query()
            ->with(['branch','group'])
            ->search($q)
            ->status($status)
            ->byBranch($branchId)
            ->byGroup($groupId)
            ->joinedBetween($from, $to)
            ->orderByDesc('id')
            ->paginate(15)
            ->withQueryString();

        return view('students-modern.index', [
            'students' => $students,
            'branches' => Branch::orderBy('name')->get(['id','name']),
            'groups' => Group::orderBy('name')->get(['id','name']),
        ]);
    }

    public function create()
    {
        $branches = Branch::orderBy('name')->get(['id','name']);
        $groups = Group::orderBy('name')->get(['id','name']);
        $coaches = \App\Models\User::role('coach')->orderBy('name')->get(['id','name']);
        $sportDisciplines = collect(config('sport_disciplines'));
        return view('students-modern.create', [
            'branches' => $branches,
            'groups' => $groups,
            'membershipTypes' => [
                'self-sponsored' => 'Self Sponsored',
                'dtfa-sponsored' => 'DTFA Sponsored',
            ],
            'sportDisciplines' => $sportDisciplines,
            'coaches' => $coaches,
        ]);
    }

    public function store(StoreStudentRequest $request)
    {
        $data = $request->validated();
        if (empty($data['registered_by'])) {
            $data['registered_by'] = auth()->id();
        }
        $student = new Student($data);
        $student->save();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos/students', 'public');
            $student->photo_path = $path;
            $student->save();
        }

        // Send registration confirmation via queue if we have a recipient
        try {
            $recipient = $student->email ?: optional($student->parent)->email;
            if ($recipient) {
                Mail::to($recipient)->queue(new StudentRegistered($student));
            }
        } catch (\Throwable $e) {
            // Silently ignore mail errors to not block creation; consider logging if desired
        }

        return redirect()->route('students-modern.show', $student)->with('status', 'Student created');
    }

    public function show(Student $students_modern)
    {
        // Route-model binding key is named by resource; adjust parameter name for clarity
        $student = $students_modern;
        $student->load(['branch','group']);
        return view('students-modern.show', compact('student'));
    }

    public function edit(Student $students_modern)
    {
        $student = $students_modern;
        $branches = Branch::orderBy('name')->get(['id','name']);
        $groups = Group::orderBy('name')->get(['id','name']);
        $coaches = \App\Models\User::role('coach')->orderBy('name')->get(['id','name']);
        $sportDisciplines = collect(config('sport_disciplines'));
        return view('students-modern.edit', [
            'student' => $student,
            'branches' => $branches,
            'groups' => $groups,
            'membershipTypes' => [
                'self-sponsored' => 'Self Sponsored',
                'dtfa-sponsored' => 'DTFA Sponsored',
            ],
            'sportDisciplines' => $sportDisciplines,
            'coaches' => $coaches,
        ]);
    }

    public function update(UpdateStudentRequest $request, Student $students_modern)
    {
        $student = $students_modern;
        $data = $request->validated();
        if (empty($data['registered_by'])) {
            $data['registered_by'] = $student->registered_by ?: auth()->id();
        }
        $student->fill($data)->save();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos/students', 'public');
            $student->photo_path = $path;
            $student->save();
        }

        return redirect()->route('students-modern.show', $student)->with('status', 'Student updated');
    }

    public function destroy(Student $students_modern)
    {
        $student = $students_modern;
        $student->delete();
        return redirect()->route('students-modern.index')->with('status', 'Student deleted');
    }
}
