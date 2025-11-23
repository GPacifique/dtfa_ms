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

        // pick random keys (stored values) from the options
        $activityKeys = array_keys($activities);
        $statusKeys = array_keys($statuses);

        $activity = count($activityKeys) ? $activityKeys[array_rand($activityKeys)] : null;
        $status = count($statusKeys) ? $statusKeys[array_rand($statusKeys)] : 'available';
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
