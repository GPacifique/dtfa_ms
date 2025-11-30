<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpcomingEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'event_name',
        'date',
        'venue',
        'starting_time',
        'ending_time',
        'objective',
        'targeted_audience',
        'coordinator_name',
        'supporting_staff_names',
        'is_paid',
        'amount',
        'currency',
        'status',
    ];

    protected $casts = [
        'date' => 'date',
        'starting_time' => 'string',
        'ending_time' => 'string',
        'is_paid' => 'boolean',
        'amount' => 'decimal:2',
        'supporting_staff_names' => 'array',
        'status' => 'string',
    ];

    /**
     * Status checking methods
     */
    public function isUpcoming(): bool
    {
        return $this->status === 'upcoming';
    }

    public function isOngoing(): bool
    {
        return $this->status === 'ongoing';
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
    public function markOngoing(): void
    {
        $this->update(['status' => 'ongoing']);
    }

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
        $this->update(['status' => 'upcoming']);
    }
}
