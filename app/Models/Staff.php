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

        // Use trait method for consistent photo URL handling
        return $this->getPhotoUrlFromPath($this->photo_path, $initials, '6366f1');
    }
}
