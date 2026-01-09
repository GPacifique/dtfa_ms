<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Skip for SQLite - it doesn't support ALTER TABLE DROP FOREIGN KEY
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        // Drop the problematic foreign key and recreate it
        DB::statement('ALTER TABLE student_attendance DROP FOREIGN KEY student_attendance_student_id_foreign');

        DB::statement('ALTER TABLE student_attendance ADD CONSTRAINT student_attendance_student_id_foreign
            FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE');
    }

    public function down(): void
    {
        // Skip for SQLite
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        // Revert if needed
        DB::statement('ALTER TABLE student_attendance DROP FOREIGN KEY student_attendance_student_id_foreign');
    }
};
