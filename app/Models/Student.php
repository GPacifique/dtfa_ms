<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, HasPhoto;

    /**
     * Get all attendance records for the student.
     */
    public function attendance()
    {
        return $this->hasMany(\App\Models\StudentAttendance::class, 'student_id');
    }

    protected $fillable = [
        'first_name', 'second_name', 'dob', 'gender', 'father_name', 'mother_name', 'player_email', 'parent_email', 'emergency_phone', 'player_phone', 'photo_path', 'status', 'registered_by', 'jersey_number', 'jersey_name', 'sport_discipline', 'school_name', 'position', 'coach', 'joined_at', 'program', 'branch_id', 'group_id', 'training_days', 'membership_type'
    ];

    protected $casts = [
        'dob' => 'date',
        'joined_at' => 'datetime',
        'training_days' => 'array',
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

        // If student has a photo, use the route-based URL (bypasses symlink issues on shared hosting)
        if ($this->photo_path) {
            return route('student.photo', $this->id);
        }

        // Fallback to SVG avatar
        return $this->generateSvgAvatar($initials);
    }

    /**
     * Generate an SVG avatar with initials
     */
    protected function generateSvgAvatar(string $initials): string
    {
        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
    <rect width="128" height="128" fill="#3b82f6"/>
    <text x="50%" y="50%" font-family="ui-sans-serif, system-ui, sans-serif" font-size="52" font-weight="600" fill="#ffffff" text-anchor="middle" dy=".35em">{$initials}</text>
</svg>
SVG;
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
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
               ->orWhere('player_email', 'like', "%$q%")
               ->orWhere('parent_email', 'like', "%$q%")
               ->orWhere('player_phone', 'like', "%$q%")
               ->orWhere('emergency_phone', 'like', "%$q%")
               ->orWhere('jersey_name', 'like', "%$q%")
               ->orWhere('jersey_number', 'like', "%$q%")
               ->orWhere('school_name', 'like', "%$q%")
               ->orWhere('coach', 'like', "%$q%")
               ->orWhere('sport_discipline', 'like', "%$q%");
        });
    }
}
