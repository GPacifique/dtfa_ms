<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $s = \App\Models\Student::create([
            'first_name' => 'Auto',
            'second_name' => 'Student',
            'email' => 'auto.student@example.com',
            'phone' => '+250700000001',
            'status' => 'active',
        ]);

        $this->command->info('Created test student id: '.$s->id);
    }
}
