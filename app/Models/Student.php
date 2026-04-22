<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Student extends Model
{
    use HasFactory;

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
        'membership_type'
    ];

    protected $casts = [
        'dob' => 'date',
        'joined_at' => 'datetime',
        'training_days' => 'array',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_user_id');
    }

    public function registeredBy()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function attendances()
    {
        return $this->hasMany(StudentAttendance::class);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getPhotoUrlAttribute(): string
    {
        // If image exists → use storage symlink
        if ($this->photo_path && Storage::disk('public')->exists($this->photo_path)) {
            return asset('storage/' . $this->photo_path);
        }

        // Fallback → SVG avatar with initials
        return $this->generateSvgAvatar();
    }

    public function getAgeAttribute()
    {
        return $this->dob ? Carbon::parse($this->dob)->age : null;
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    protected function generateSvgAvatar(): string
    {
        $second = $this->second_name ?? 'T';
        $initials = strtoupper(
            mb_substr($this->first_name ?? 'S', 0, 1) .
            mb_substr($second, 0, 1)
        );

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
    <rect width="128" height="128" fill="#3b82f6"/>
    <text x="50%" y="50%" font-family="Arial, sans-serif" font-size="52" font-weight="600" fill="#ffffff" text-anchor="middle" dy=".35em">{$initials}</text>
</svg>
SVG;

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */

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