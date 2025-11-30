<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityPlan extends Model
{
    protected $fillable = [
        'year',
        'country',
        'challenge',
        'opportunity',
        'baseline',
        'intervention_objective',
        'list_of_activities',
        'kpi',
        'responsible_person_id',
        'focus_area',
        'starting_date',
        'ending_date',
        'cost',
        'financing_mechanism',
        'status',
        'status_remarks',
    ];

    protected $casts = [
        'starting_date' => 'date',
        'ending_date' => 'date',
        'cost' => 'decimal:2',
        'list_of_activities' => 'array',
        'year' => 'integer',
    ];

    /**
     * Get the responsible person (staff member)
     */
    public function responsiblePerson(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'responsible_person_id');
    }

    /**
     * Status checking methods
     */
    public function isNotAchieved(): bool
    {
        return $this->status === 'red';
    }

    public function isOngoing(): bool
    {
        return $this->status === 'yellow';
    }

    public function isAchieved(): bool
    {
        return $this->status === 'green';
    }

    /**
     * Status transition methods
     */
    public function markNotAchieved(): self
    {
        $this->update(['status' => 'red']);
        return $this;
    }

    public function markOngoing(): self
    {
        $this->update(['status' => 'yellow']);
        return $this;
    }

    public function markAchieved(): self
    {
        $this->update(['status' => 'green']);
        return $this;
    }

    /**
     * Get duration in days
     */
    public function getDurationInDays(): int
    {
        return $this->ending_date->diffInDays($this->starting_date);
    }

    /**
     * Get focus area display
     */
    public function getFocusAreaDisplayAttribute(): string
    {
        return $this->focus_area;
    }

    /**
     * Get status color for UI
     */
    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'red' => 'red',
            'yellow' => 'yellow',
            'green' => 'green',
            default => 'gray',
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'red' => 'Not Achieved',
            'yellow' => 'Ongoing',
            'green' => 'Achieved',
            default => 'Unknown',
        };
    }
}
