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
        'training_pitch',
        'date',
        'start_time',
        'finish_time',
        'main_topic',
        'area_performance',
        'part1_activities',
        'part2_activities',
        'part3_notes',
        'part4_message',
        'number_of_kids',
        'incident_report',
        'missed_damaged_equipment',
    ];

    protected $casts = [
        'date' => 'date',
    ];
}
