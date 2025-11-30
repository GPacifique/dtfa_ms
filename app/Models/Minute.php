<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Minute extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'starting_time',
        'end_time',
        'venue',
        'chaired_by',
        'note_taken_by',
        'attendance_list',
        'absent_apology',
        'absent_no_apology',
        'agenda',
        'resolution',
        'responsible_person',
        'start_date',
        'competition_date',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'start_date' => 'date',
        'competition_date' => 'date',
        'attendance_list' => 'array',
        'absent_apology' => 'array',
        'absent_no_apology' => 'array',
        'status' => 'string',
    ];

    /**
     * Status checking methods
     */
    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    /**
     * Status transition methods
     */
    public function markCompleted(): void
    {
        $this->update(['status' => 'completed']);
    }

    public function markCancelled(): void
    {
        $this->update(['status' => 'cancelled']);
    }

    public function reschedule(): void
    {
        $this->update(['status' => 'scheduled']);
    }
}
