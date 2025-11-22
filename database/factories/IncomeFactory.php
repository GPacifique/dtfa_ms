<?php

namespace Database\Factories;

use App\Models\Income;
use Illuminate\Database\Eloquent\Factories\Factory;

class IncomeFactory extends Factory
{
    protected $model = Income::class;

    public function definition()
    {
        return [
            'branch_id' => null,
            'amount_cents' => $this->faker->numberBetween(1000, 500000),
            'currency' => 'RWF',
            'category' => $this->faker->randomElement(['subscriptions','donation','cash','other']),
            'source' => $this->faker->randomElement(['cash','bank','invoice']),
            'received_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
            'notes' => $this->faker->optional()->sentence(),
            'recorded_by_user_id' => null,
        ];
    }
}
