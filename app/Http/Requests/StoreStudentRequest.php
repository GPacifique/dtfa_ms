<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'first_name' => ['required','string','max:255'],
            'second_name' => ['required','string','max:255'],
            'father_name' => ['nullable','string','max:255'],
            'mother_name' => ['nullable','string','max:255'],
            'email' => ['nullable','email','max:255'],
            'emergency_phone' => ['nullable','string','max:50'],
            'phone' => ['nullable','string','max:50'],
            'status' => ['required','in:active,inactive'],
            'dob' => ['nullable','date'],
            'gender' => ['nullable','in:male,female'],
            'registered_by' => ['nullable','exists:users,id'],
            'jersey_number' => ['nullable','string','max:50'],
            'jersey_name' => ['nullable','string','max:255'],
            'sport_discipline' => ['nullable','string','max:255'],
            'school_name' => ['nullable','string','max:255'],
            'position' => ['nullable','string','max:255'],
            'coach' => ['nullable','string','max:255'],
            'branch_id' => ['nullable','exists:branches,id'],
            'group_id' => ['nullable','exists:groups,id'],
            'joined_at' => ['nullable','date'],
            'program' => ['nullable','string','max:255'],
            'combination' => ['nullable','string','max:255'],
            'membership_type' => ['nullable','string','max:255'],
            'parent_user_id' => ['nullable','exists:users,id'],
            'photo' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ];
    }
}
