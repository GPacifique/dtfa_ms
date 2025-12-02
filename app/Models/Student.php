<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, HasPhoto;

    protected $fillable = [
        'first_name', 'second_name', 'dob', 'gender', 'father_name', 'mother_name', 'email', 'emergency_phone', 'parent_user_id', 'phone', 'photo_path', 'status', 'registered_by', 'jersey_number', 'jersey_name', 'sport_discipline', 'school_name', 'position', 'coach', 'joined_at', 'program', 'branch_id', 'group_id', 'combination', 'membership_type'
    ];

    protected $casts = [
        'dob' => 'date',
        'joined_at' => 'datetime',
    ];

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

    public function getPhotoUrlAttribute(): string
    {
        // Generate initials for fallback avatar
        $second = $this->second_name ?? $this->last_name ?? 'T';
        $initials = strtoupper(mb_substr($this->first_name ?? 'S', 0, 1) . mb_substr($second, 0, 1));

        // Use trait method for consistent photo URL handling
        return $this->getPhotoUrlFromPath($this->photo_path, $initials, '3b82f6');
    }

    public function getAgeAttribute()
    {
        return $this->dob ? \Carbon\Carbon::parse($this->dob)->age : null;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeStatus($query, ?string $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }

    public function scopeByBranch($query, $branchId)
    {
        return $branchId ? $query->where('branch_id', $branchId) : $query;
    }

    public function scopeByGroup($query, $groupId)
    {
        return $groupId ? $query->where('group_id', $groupId) : $query;
    }

    public function scopeJoinedBetween($query, ?string $from, ?string $to)
    {
        if ($from && $to) return $query->whereBetween('joined_at', [$from, $to]);
        if ($from) return $query->where('joined_at', '>=', $from);
        if ($to) return $query->where('joined_at', '<=', $to);
        return $query;
    }

    public function scopeSearch($query, ?string $q)
    {
        if (!$q) return $query;
        $q = trim($q);
        return $query->where(function ($qq) use ($q) {
            $qq->where('first_name', 'like', "%$q%")
               ->orWhere('second_name', 'like', "%$q%")
               ->orWhere('email', 'like', "%$q%")
               ->orWhere('phone', 'like', "%$q%")
               ->orWhere('jersey_name', 'like', "%$q%")
               ->orWhere('jersey_number', 'like', "%$q%")
               ->orWhere('school_name', 'like', "%$q%")
               ->orWhere('coach', 'like', "%$q%")
               ->orWhere('sport_discipline', 'like', "%$q%");
        });
    }
}
