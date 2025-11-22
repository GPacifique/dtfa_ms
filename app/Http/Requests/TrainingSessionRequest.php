<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;
use App\Models\Group;
use App\Models\User;
use App\Models\TrainingSession;

class TrainingSessionRequest extends FormRequest
{
    public function authorize()
    {
        // allow if admin via policy before(); coaches allowed to create/update their own sessions
        $user = $this->user();
        if ($user->hasRole('super-admin') || $user->hasRole('admin')) {
            return true;
        }

        if ($user->hasRole('coach')) {
            // coach may only create/edit sessions that specify their own coach_user_id
            $coachId = $this->input('coach_user_id');
            return (int)$coachId === (int)$user->id;
        }

        return false;
    }

    public function rules()
    {
        $id = $this->route('session')?->id ?? null;

        return [
            'date' => ['required','date'],
            'start_time' => ['required'],
            'end_time' => ['required','after:start_time'],
            'location' => ['required','string','max:255'],
            'coach_user_id' => ['required','integer','exists:users,id'],
            'branch_id' => ['required','integer','exists:branches,id'],
            'group_id' => ['required','integer','exists:groups,id'],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($v) {
            $data = $this->validated();

            // group must belong to branch
            $group = Group::find($data['group_id'] ?? null);
            if (!$group || $group->branch_id != $data['branch_id']) {
                $v->errors()->add('group_id', 'Selected group does not belong to the chosen branch.');
            }

            // coach must belong to branch (User.branch_id)
            $coach = User::find($data['coach_user_id'] ?? null);
            if (!$coach || ($coach->branch_id ?? null) != $data['branch_id']) {
                $v->errors()->add('coach_user_id', 'Selected coach does not belong to the chosen branch.');
            }

            // check overlapping sessions for same group on same date
            if (!empty($data['group_id']) && !empty($data['date']) && !empty($data['start_time']) && !empty($data['end_time'])) {
                $q = TrainingSession::where('group_id', $data['group_id'])
                    ->whereDate('date', $data['date']);

                if ($this->route('session')) {
                    $q->where('id', '!=', $this->route('session')->id);
                }

                $overlap = $q->where(function($qq) use ($data) {
                    $qq->where(function($t) use ($data) {
                        $t->where('start_time', '<', $data['end_time'])
                          ->where('end_time', '>', $data['start_time']);
                    });
                })->exists();

                if ($overlap) {
                    $v->errors()->add('start_time', 'This time overlaps another session for the selected group.');
                }
            }
        });
    }
}
