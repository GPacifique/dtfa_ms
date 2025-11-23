<?php

namespace App\Services;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentService
{
    /**
     * Create a student for a coach (assign branch/group automatically).
     * @param Request $request
     * @param \Illuminate\Contracts\Auth\Authenticatable $coach
     * @return Student
     */
    public function createForCoach(Request $request, $coach)
    {
        $data = $this->validatePayload($request);

        $student = new Student();
        $student->first_name = $data['first_name'];
        $student->second_name = $data['second_name'];
        $student->dob = $data['dob'] ?? null;
        $student->gender = $data['gender'] ?? null;
        $student->phone = $data['phone'] ?? null;
        $student->status = $data['status'];
        $student->branch_id = $coach->branch_id ?? null;
        $student->group_id = $coach->group_id ?? null;
        $student->parent_user_id = $data['parent_user_id'] ?? null;

        if ($request->hasFile('photo')) {
            $student->photo_path = $request->file('photo')->store('photos/students', 'public');
        }

        $student->save();

        return $student;
    }

    /**
     * Update a student from request data.
     * @param Student $student
     * @param Request $request
     * @return Student
     */
    public function updateFromRequest(Student $student, Request $request)
    {
        $data = $this->validatePayload($request);

        $student->first_name = $data['first_name'];
        $student->second_name = $data['second_name'];
        $student->dob = $data['dob'] ?? null;
        $student->gender = $data['gender'] ?? null;
        $student->phone = $data['phone'] ?? null;
        $student->status = $data['status'];

        if ($request->hasFile('photo')) {
            $student->photo_path = $request->file('photo')->store('photos/students', 'public');
        }

        $student->save();

        return $student;
    }

    protected function validatePayload(Request $request): array
    {
        return $request->validate([
            'first_name' => 'required|string|max:255',
            'second_name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'phone' => 'nullable|string|max:255',
            'status' => 'required|string',
            'photo' => 'nullable|image|max:2048',
            'parent_user_id' => 'nullable|integer',
        ]);
    }
}
