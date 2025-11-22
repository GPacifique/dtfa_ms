<?php

namespace Database\Factories;

use App\Models\StaffAttendance;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffAttendanceFactory extends Factory
{
    protected $model = StaffAttendance::class;

    public function definition()
    {
        // Ensure there's a staff user to reference (fallback to factory)
        $staff = User::inRandomOrder()->first() ?? User::factory()->create();
        $activities = StaffAttendance::activityOptions();
        $statuses = StaffAttendance::statusOptions();

        // Create a local Faker generator to ensure availability outside test helpers
        $faker = \Faker\Factory::create();

        return [
            'staff_id' => $staff->id,
            'activity_type' => $faker->randomElement($activities),
            'date' => $faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'status' => $faker->randomElement($statuses),
            'notes' => $faker->optional()->sentence(),
        ];
    }
}
