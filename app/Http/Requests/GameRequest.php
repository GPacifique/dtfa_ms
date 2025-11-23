<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GameRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user() != null;
    }

    public function rules()
    {
        return [
            'home_team_id' => 'required|exists:teams,id|different:away_team_id',
            'away_team_id' => 'required|exists:teams,id|different:home_team_id',
            'venue' => 'nullable|string|max:255',
            'scheduled_at' => 'nullable|date',
            'status' => 'nullable|in:scheduled,played,cancelled',
            'score_home' => 'nullable|integer',
            'score_away' => 'nullable|integer',
        ];
    }
}
