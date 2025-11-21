<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffAttendance extends Model
{
    use HasFactory;

    protected $table = 'staff_attendances';

    protected $fillable = [
        'staff_id',
        'activity_type',
        'date',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public static function activityOptions(): array
    {
        return [
            'Training Session',
            'In House Training',
            'Outside Training',
            'Meeting',
            'Event',
            'Trip',
        ];
    }

    public static function statusOptions(): array
    {
        return [
            'Available',
            'Not available',
            'Will be late',
        ];
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
