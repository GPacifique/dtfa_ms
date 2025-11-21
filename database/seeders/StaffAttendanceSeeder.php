<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StaffAttendance;

class StaffAttendanceSeeder extends Seeder
{
    public function run()
    {
        // Create 25 sample attendances (will only attach staff_id if users exist)
        StaffAttendance::factory()->count(25)->create();
    }
}
