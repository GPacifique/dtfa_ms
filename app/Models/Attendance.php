<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    // Table name (optional if follows Laravel convention)
    protected $table = 'attendances';

    // Mass assignable fields
    protected $fillable = [
        'student_id',
        'attendance_date',
        'status', // present, absent, late, etc.
        'remarks',
    ];

    // Casts (important for date handling)
    protected $casts = [
        'attendance_date' => 'date',
    ];

    /**
     * علاقة الطالب (Each attendance belongs to one student)
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}