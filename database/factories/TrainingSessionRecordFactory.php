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

        $faker = $this->faker ?? \Faker\Factory::create();

        return [
            'coach_id' => $coach?->id,
            'coach_name' => $coach?->name,
            'branch' => $faker->randomElement(['Rwanda','Tanzania']),
            'training_pitch' => $faker->word(),
            'date' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'start_time' => $faker->time('H:i:s'),
            'finish_time' => $faker->time('H:i:s'),
            'main_topic' => $faker->sentence(3),
            'area_performance' => $faker->word(),
            'part1_activities' => $faker->paragraph(),
            'part2_activities' => $faker->paragraph(),
            'part3_notes' => $faker->paragraph(),
            'part4_message' => $faker->sentence(),
            'number_of_kids' => $faker->numberBetween(0,50),
            'incident_report' => $faker->optional()->sentence(),
            'missed_damaged_equipment' => $faker->optional()->sentence(),
        ];
    }
}
