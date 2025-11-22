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

        // Use the global fake() helper to avoid cases where $this->faker is null
        return [
            'staff_id' => $staff->id,
            'activity_type' => fake()->randomElement($activities),
            'date' => fake()->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'status' => fake()->randomElement($statuses),
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
