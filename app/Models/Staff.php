<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

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
        $path = $this->photo_path;
        if ($path) {
            try {
                return \Illuminate\Support\Facades\Storage::disk('public')->url(ltrim($path, '/'));
            } catch (\Throwable $e) {
                return asset('storage/' . ltrim($path, '/'));
            }
        }
        // Fallback to UI Avatars with initials
        $initials = strtoupper(mb_substr($this->first_name ?? 'S', 0, 1) . mb_substr($this->last_name ?? 'T', 0, 1));
        $bg = '6366f1'; // indigo-500
        $fg = 'ffffff';
        return "https://ui-avatars.com/api/?name=" . urlencode($initials) . "&background={$bg}&color={$fg}&size=128&bold=true";
    }
}
