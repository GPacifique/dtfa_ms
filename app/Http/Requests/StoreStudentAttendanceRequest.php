<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentAttendanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'student_id' => 'required|exists:students,id',
            'training_session_id' => 'required|exists:training_session_records,id',
            'status' => 'required|in:present,absent,late,excused',
            'notes' => 'nullable|string|max:1000',
        ];
    }
}
