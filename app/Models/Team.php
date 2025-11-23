<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    public function players()
    {
        return $this->hasMany(\App\Models\Player::class);
    }

    public function homeMatches()
    {
        return $this->hasMany(\App\Models\Game::class, 'home_team_id');
    }

    public function awayMatches()
    {
        return $this->hasMany(\App\Models\Game::class, 'away_team_id');
    }
}
