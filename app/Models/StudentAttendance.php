<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StudentAttendance extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'student_id',
        'training_session_id',
        'status',
        'notes',
        'recorded_by_user_id',
    ];

    /**
     * Scope a query to only include a given status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope a query to only include a given session.
     */
    public function scopeSession($query, $sessionId)
    {
        return $query->where('training_session_id', $sessionId);
    }

    /**
     * Scope a query to only include a given student.
     */
    public function scopeStudent($query, $studentId)
    {
        return $query->where('student_id', $studentId);
    }


    public function student()
    {
        return $this->belongsTo(Student::class);
    }


    public function session()
    {
        return $this->belongsTo(TrainingSessionRecord::class, 'training_session_id');
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by_user_id');
    }
}
