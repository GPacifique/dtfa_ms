<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StaffTask extends Model
{
    use HasFactory;

    protected $table = 'staff_tasks';

    protected $fillable = [
        'title',
        'description',
        'assigned_to',
        'status',
        'due_date',
        'priority',
    ];

    public function assignee()
    {
        return $this->belongsTo(Staff::class, 'assigned_to');
    }
}
