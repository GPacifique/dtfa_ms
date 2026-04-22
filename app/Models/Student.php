<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, HasPhoto;

    protected $fillable = [
        'first_name',
        'second_name',
        'dob',
        'gender',
        'father_name',
        'mother_name',
        'player_email',
        'parent_email',
        'emergency_phone',
        'player_phone',
        'photo_path',
        'status',
        'registered_by',
        'jersey_number',
        'jersey_name',
        'sport_discipline',
        'school_name',
        'position',
        'coach',
        'joined_at',
        'program',
        'branch_id',
        'group_id',
        'training_days',
        'membership_type',
        'parent_user_id',
    ];

    protected $casts = [
        'dob' => 'date',
        'joined_at' => 'datetime',
        'training_days' => 'array',
    ];

    /* ---------------- RELATIONS ---------------- */

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_user_id');
    }

    public function registeredBy()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function attendances()
    {
        return $this->hasMany(StudentAttendance::class);
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /* ---------------- PHOTO (SYMLINK ONLY) ---------------- */

    public function getPhotoUrlAttribute(): string
    {
        // If photo exists → always use storage symlink
        if ($this->photo_path) {
            return asset('storage/' . $this->photo_path);
        }

        // fallback default image (no DB check, no storage check)
        return asset('images/default.png');
    }

    /* ---------------- AGE ---------------- */

    public function getAgeAttribute()
    {
        return $this->dob ? \Carbon\Carbon::parse($this->dob)->age : null;
    }

    /* ---------------- SCOPES ---------------- */

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeStatus($query, ?string $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeSearch($query, ?string $q)
    {
        if (!$q) return $query;

        $q = trim($q);

        return $query->where(function ($qq) use ($q) {
            $qq->where('first_name', 'like', "%$q%")
                ->orWhere('second_name', 'like', "%$q%")
                ->orWhere('player_email', 'like', "%$q%")
                ->orWhere('parent_email', 'like', "%$q%")
                ->orWhere('player_phone', 'like', "%$q%")
                ->orWhere('jersey_name', 'like', "%$q%")
                ->orWhere('jersey_number', 'like', "%$q%")
                ->orWhere('school_name', 'like', "%$q%")
                ->orWhere('sport_discipline', 'like', "%$q%");
        });
    }
}