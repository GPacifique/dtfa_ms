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
    ];
}
