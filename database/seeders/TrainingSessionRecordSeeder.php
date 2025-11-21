<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TrainingSessionRecord;

class TrainingSessionRecordSeeder extends Seeder
{
    public function run()
    {
        TrainingSessionRecord::factory()->count(15)->create();
    }
}
