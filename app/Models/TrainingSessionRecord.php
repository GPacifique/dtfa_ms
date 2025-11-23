<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingSessionRecord extends Model
{
    use HasFactory;

    protected $table = 'training_session_records';

    protected $fillable = [
        'coach_id',
        'coach_name',
        'branch',
        'country',
        'city',
        'training_pitch',
        'other_training_pitch',
        'sport_discipline',
        'training_objective',
        'date',
        'start_time',
        'finish_time',
        'main_topic',
        'area_performance',
        'part1_activities',
        'part1_a1_desc',
        'part1_a1_time',
        'part1_a2_desc',
        'part1_a2_time',
        'part1_a3_desc',
        'part1_a3_time',
        'part2_activities',
        'part2_a1_desc',
        'part2_a1_time',
        'part2_a2_desc',
        'part2_a2_time',
        'part2_a3_desc',
        'part2_a3_time',
        'part3_notes',
        'part4_message',
        'number_of_kids',
        'incident_report',
        'missed_damaged_equipment',
        'comments',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
