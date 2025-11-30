<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class game extends Model
{
    use HasFactory;

    protected $fillable = [
        'discipline', 'home_team', 'home_color', 'away_team', 'away_color',
        'objective', 'date', 'time', 'departure_time', 'expected_finish_time',
        'category', 'transport', 'venue', 'age_group', 'country', 'city',
        'base', 'gender', 'staff_ids', 'notify_staff', 'player_ids',
        'home_score', 'away_score', 'yellow_cards_players', 'red_cards_players',
        'yellow_cards_staff', 'red_cards_staff', 'incidence', 'technical_feedback'
    ];

    protected $casts = [
        'staff_ids' => 'array',
        'player_ids' => 'array',
        'yellow_cards_players' => 'array',
        'red_cards_players' => 'array',
        'yellow_cards_staff' => 'array',
        'red_cards_staff' => 'array',
        'notify_staff' => 'boolean',
    ];
}
