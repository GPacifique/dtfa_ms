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
            'father_name' => ['nullable','string','max:255'],
            'mother_name' => ['nullable','string','max:255'],
            'player_email' => ['nullable','email','max:255'],
            'parent_email' => ['nullable','email','max:255'],
            'emergency_phone' => ['nullable','string','max:50'],
            'player_phone' => ['nullable','string','max:50'],
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

    protected function prepareForValidation(): void
    {
        $data = $this->all();
        if (isset($data['branch_id']) && !is_numeric($data['branch_id']) && is_string($data['branch_id'])) {
            $branch = \App\Models\Branch::where('name', $data['branch_id'])->first();
            if ($branch) {
                $this->merge(['branch_id' => $branch->id]);
            }
        }
        if (isset($data['group_id']) && !is_numeric($data['group_id']) && is_string($data['group_id'])) {
            $group = \App\Models\Group::where('name', $data['group_id'])->first();
            if ($group) {
                $this->merge(['group_id' => $group->id]);
            }
        }
    }
}
