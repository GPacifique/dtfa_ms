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

        // Use simple PHP randomization to avoid depending on Faker at runtime
        $activity = count($activities) ? $activities[array_rand($activities)] : null;
        $status = count($statuses) ? $statuses[array_rand($statuses)] : 'present';
        $date = \Carbon\Carbon::now()->subDays(rand(0, 30))->format('Y-m-d');
        $notes = rand(0, 4) === 0 ? 'Auto-generated attendance note' : null;

        return [
            'staff_id' => $staff->id,
            'activity_type' => $activity,
            'date' => $date,
            'status' => $status,
            'notes' => $notes,
        ];
    }
}
