<?php
namespace App\Models;


use Illuminate\Database\Eloquent\Model;


class StudentAttendance extends Model
{
protected $table = 'student_attendance';


protected $fillable = [
'student_id',
'attendance_date',
'status',
'remarks',
'recorded_by'
];

protected $casts = [
'attendance_date' => 'datetime',
];


public function student()
{
return $this->belongsTo(Student::class);
}
}
