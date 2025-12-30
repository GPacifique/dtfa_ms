<?php

namespace App\Models;

use App\Traits\HasPhoto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory, HasPhoto;

    protected $table = 'staff';

    protected $fillable = [
        'first_name',
        'last_name',
        'branch',
        'discipline',
        'gender',
        'dob',
        'role_function',
        'date_entry',
        'date_exit',
        'other_organizations',
        'academic_qualification',
        'major',
        'professional_certificates',
        'tshirt_size',
        'short_size',
        'top_tracksuit_size',
        'pant_tracksuit_size',
        'email',
        'phone_number',
        'status',
        'photo_path',
    ];

    protected $casts = [
        'dob' => 'date',
        'date_entry' => 'date',
        'date_exit' => 'date',
    ];

    public function getPhotoUrlAttribute(): string
    {
        // Generate initials for fallback avatar
        $initials = strtoupper(mb_substr($this->first_name ?? 'S', 0, 1) . mb_substr($this->last_name ?? 'T', 0, 1));

        // If staff has a photo, use the route-based URL (bypasses symlink issues on shared hosting)
        if ($this->photo_path) {
            return route('staff.photo', $this->id);
        }

        // Fallback to SVG avatar
        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 128 128">
    <rect width="128" height="128" fill="#6366f1"/>
    <text x="50%" y="50%" font-family="ui-sans-serif, system-ui, sans-serif" font-size="52" font-weight="600" fill="#ffffff" text-anchor="middle" dy=".35em">{$initials}</text>
</svg>
SVG;
        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    }
}
