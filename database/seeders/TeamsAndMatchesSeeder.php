<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Team;
use App\Models\Player;
use App\Models\Game;

class TeamsAndMatchesSeeder extends Seeder
{
    public function run()
    {
        // Create 4 sample teams
        $teams = Team::factory()->count(4)->create();

        // Create players for teams
        foreach ($teams as $team) {
            Player::factory()->count(12)->create(['team_id' => $team->id]);
        }

        // Create matches
        Game::factory()->count(6)->create();
    }
}
