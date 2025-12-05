<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RealProductionStudentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Imports all 290 students from production SQL file
     */
    public function run(): void
    {
        $this->command->info('Starting to import production students...');

        // Path to the SQL file (the one you provided)
        $sqlFile = base_path('students.sql');

        if (!File::exists($sqlFile)) {
            $this->command->error("SQL file not found at: {$sqlFile}");
            $this->command->info("Please place your 'students (2).sql' file in the project root and rename it to 'students.sql'");
            return;
        }

        try {
            // Read the SQL file
            $sql = File::get($sqlFile);

            // Extract only the INSERT statements for students table
            preg_match('/INSERT INTO `students`.*?VALUES\s*(.*?);/s', $sql, $matches);

            if (empty($matches[1])) {
                $this->command->error('No INSERT statements found in SQL file');
                return;
            }

            // Disable foreign key checks and strict mode temporarily
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_DATE',''));");
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode,'NO_ZERO_IN_DATE',''));");

            // Clear existing students (optional - comment out if you want to keep existing)
            // DB::table('students')->truncate();

            // Replace invalid dates with NULL
            $valuesString = $matches[1];
            $valuesString = str_replace("'0000-00-00'", "NULL", $valuesString);
            $valuesString = str_replace("'0000-00-00 00:00:00'", "NULL", $valuesString);

            // Execute the INSERT statement
            $insertSql = "INSERT INTO `students` (`id`, `first_name`, `second_name`, `dob`, `gender`, `father_name`, `email`, `emergency_phone`, `mother_name`, `parent_user_id`, `phone`, `photo_path`, `status`, `registered_by`, `jersey_number`, `jersey_name`, `sport_discipline`, `school_name`, `position`, `coach`, `joined_at`, `program`, `branch_id`, `group_id`, `combination`, `membership_type`, `created_at`, `updated_at`) VALUES " . $valuesString;

            DB::unprepared($insertSql);

            // Re-enable foreign key checks and restore strict mode
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',NO_ZERO_DATE,NO_ZERO_IN_DATE'));");

            $count = DB::table('students')->count();
            $this->command->info("✓ Successfully imported {$count} students!");

        } catch (\Exception $e) {
            // Restore settings on error
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            DB::statement("SET sql_mode=(SELECT CONCAT(@@sql_mode, ',NO_ZERO_DATE,NO_ZERO_IN_DATE'));");

            $this->command->error('Error importing students: ' . $e->getMessage());
            $this->command->error('Line: ' . $e->getLine());
        }
    }
}
