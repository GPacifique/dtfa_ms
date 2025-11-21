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
        $staff = User::inRandomOrder()->first();
        $activities = StaffAttendance::activityOptions();
        $statuses = StaffAttendance::statusOptions();

        return [
            'staff_id' => $staff?->id,
            'activity_type' => $this->faker->randomElement($activities),
            'date' => $this->faker->dateTimeBetween('-1 month', '+1 month')->format('Y-m-d'),
            'status' => $this->faker->randomElement($statuses),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
