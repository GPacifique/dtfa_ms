<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition()
    {
        $faker = $this->faker ?? \Faker\Factory::create();
        return [
            'branch_id' => null,
            'amount_cents' => $faker->numberBetween(1000, 500000),
            'currency' => 'RWF',
            'category' => $faker->randomElement(['subscriptions','donation','cash','other']),
            'source' => $faker->randomElement(['cash','bank','invoice']),
            'received_at' => $faker->dateTimeBetween('-1 month', 'now'),
            'notes' => $faker->optional()->sentence(),
            'recorded_by_user_id' => null,
        ];
    }
}
