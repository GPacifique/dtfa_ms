<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'status', 'discipline', 'home_team', 'home_color', 'away_team', 'away_color',
        'objective', 'date', 'time', 'departure_time', 'expected_finish_time',
        'category', 'transport', 'venue', 'age_group', 'country', 'city',
        'base', 'gender', 'staff_ids', 'notify_staff', 'player_ids',
        'home_score', 'away_score', 'yellow_cards_players', 'red_cards_players',
        'yellow_cards_staff', 'red_cards_staff', 'incidence', 'technical_feedback'
    ];

    protected $casts = [
        'date' => 'date',
        'staff_ids' => 'array',
        'player_ids' => 'array',
        'age_group' => 'array',
        'yellow_cards_players' => 'array',
        'red_cards_players' => 'array',
        'yellow_cards_staff' => 'array',
        'red_cards_staff' => 'array',
        'notify_staff' => 'boolean',
    ];

    /**
     * Scope queries by status
     */
    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Status checks
     */
    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    public function isInProgress(): bool
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    /**
     * Status transitions
     */
    public function startMatch(): void
    {
        $this->update(['status' => 'in_progress']);
    }

    public function completeMatch(): void
    {
        $this->update(['status' => 'completed']);
    }
}
