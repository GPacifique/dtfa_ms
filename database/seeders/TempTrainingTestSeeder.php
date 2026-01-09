<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Branch;
use App\Models\Group;
use App\Models\User;
use App\Models\TrainingSession;
use App\Models\TrainingSessionRecord;
use Illuminate\Support\Str;

class TempTrainingTestSeeder extends Seeder
{
    public function run()
    {
        // Create or find a branch
        $branch = Branch::firstOrCreate(['name' => 'Test Branch']);

        // Create or find a group under that branch
        $group = Group::firstOrCreate([
            'branch_id' => $branch->id,
            'name' => 'Test Group',
        ], [
            'branch_id' => $branch->id,
            'name' => 'Test Group',
        ]);

        // Create a coach user
        $email = 'test-coach+' . Str::random(6) . '@example.test';
        $coach = User::create([
            'name' => 'Test Coach',
            'email' => $email,
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
            'branch_id' => $branch->id,
            'group_id' => $group->id,
        ]);

        // If roles are available, assign coach role
        try {
            if (method_exists($coach, 'assignRole')) {
                $coach->assignRole('coach');
            }
        } catch (\Throwable $e) {
            // ignore
        }

        // Create a training session
        $session = TrainingSession::create([
            'date' => now()->toDateString(),
            'start_time' => '09:00:00',
            'end_time' => '10:00:00',
            'location' => $branch->name,
            'group_name' => $group->name,
            'coach_user_id' => $coach->id,
            'branch_id' => $branch->id,
            'group_id' => $group->id,
        ]);

        // Create a training session record
        TrainingSessionRecord::create([
            'coach_id' => $coach->id,
            'coach_name' => $coach->name,
            'branch' => $branch->name,
            'training_pitch' => $group->name,
            'date' => now()->toDateString(),
            'start_time' => '09:00:00',
            'finish_time' => '10:00:00',
            'main_topic' => 'Test Topic',
            'area_performance' => 'Test Area',
            'part1_activities' => 'Warmup',
            'part2_activities' => 'Drills',
            'part3_notes' => 'Notes',
            'part4_message' => 'Good job',
            'number_of_kids' => 12,
            'incident_report' => '',
            'missed_damaged_equipment' => '',
        ]);
    }
}
