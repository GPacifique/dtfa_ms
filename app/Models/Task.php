<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'goal',
        'objective',
        'activities',
        'start_date',
        'end_date',
        'reporting',
        'message',
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
