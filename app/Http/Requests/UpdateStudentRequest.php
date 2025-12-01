<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'email' => ['nullable','email','max:255'],
            'phone' => ['nullable','string','max:50'],
            'status' => ['required','in:active,inactive'],
            'dob' => ['nullable','date'],
            'gender' => ['nullable','in:male,female'],
            'branch_id' => ['nullable','exists:branches,id'],
            'group_id' => ['nullable','exists:groups,id'],
            'joined_at' => ['nullable','date'],
            'photo' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ];
    }
}
