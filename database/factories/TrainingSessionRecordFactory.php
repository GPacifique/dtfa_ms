<?php

namespace Database\Factories;

use App\Models\TrainingSessionRecord;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrainingSessionRecordFactory extends Factory
{
    protected $model = TrainingSessionRecord::class;

    public function definition()
    {
        $coach = User::inRandomOrder()->first();

        return [
            'coach_id' => $coach?->id,
            'coach_name' => $coach?->name,
            'branch' => $this->faker->randomElement(['Rwanda','Tanzania']),
            'training_pitch' => $this->faker->word(),
            'date' => $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'start_time' => $this->faker->time('H:i:s'),
            'finish_time' => $this->faker->time('H:i:s'),
            'main_topic' => $this->faker->sentence(3),
            'area_performance' => $this->faker->word(),
            'part1_activities' => $this->faker->paragraph(),
            'part2_activities' => $this->faker->paragraph(),
            'part3_notes' => $this->faker->paragraph(),
            'part4_message' => $this->faker->sentence(),
            'number_of_kids' => $this->faker->numberBetween(0,50),
            'incident_report' => $this->faker->optional()->sentence(),
            'missed_damaged_equipment' => $this->faker->optional()->sentence(),
        ];
    }
}
