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
            'training_session' => 'Training Session',
            'in_house_training' => 'In House Training',
            'outside_training' => 'Outside Training',
            'meeting' => 'Meeting',
            'event' => 'Event',
            'trip' => 'Trip',
        ];
    }

    public static function statusOptions(): array
    {
        return [
            'available' => 'Available',
            'not_available' => 'Not available',
            'will_be_late' => 'Will be late',
        ];
    }

    public static function activityKeys(): array
    {
        return array_keys(static::activityOptions());
    }

    public static function statusKeys(): array
    {
        return array_keys(static::statusOptions());
    }

    public static function activityLabel(?string $key): ?string
    {
        if (!$key) return null;
        return static::activityOptions()[$key] ?? $key;
    }

    public static function statusLabel(?string $key): ?string
    {
        if (!$key) return null;
        return static::statusOptions()[$key] ?? $key;
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
}
