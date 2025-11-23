<?php

namespace Database\Factories;

use App\Models\Game;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
{
    protected $model = Game::class;

    public function definition()
    {
        $home = Team::inRandomOrder()->value('id');
        $away = Team::where('id', '!=', $home)->inRandomOrder()->value('id') ?? Team::inRandomOrder()->value('id');
        return [
            'home_team_id' => $home,
            'away_team_id' => $away,
            'venue' => $this->faker->city,
            'scheduled_at' => $this->faker->dateTimeBetween('+1 days', '+30 days'),
            'status' => 'scheduled',
        ];
    }
}
