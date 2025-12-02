<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InhouseTraining extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'second_name',
        'gender',
        'country',
        'city',
        'discipline',
        'branch_id',
        'role_id',
        'training_name',
        'channel',
        'training_date',
        'start',
        'end',
        'cost',
        'notes',
        'training_category',
        'venue',
        'location',
        'trainer_name',
    ];

    protected $casts = [
        'training_date' => 'date',
        'start' => 'datetime',
        'end' => 'datetime',
    ];

    // Relationships
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}

