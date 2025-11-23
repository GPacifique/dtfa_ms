<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition()
    {
        return [
            'team_id' => Team::inRandomOrder()->value('id') ?? null,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'position' => $this->faker->randomElement(['GK','DEF','MID','FWD']),
            'number' => $this->faker->numberBetween(1,99),
        ];
    }
}
