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

        // Check if the foreign key exists before trying to drop it
        $foreignKeyExists = DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = DATABASE()
            AND TABLE_NAME = 'student_attendance'
            AND CONSTRAINT_NAME = 'student_attendance_student_id_foreign'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        ");

        if (!empty($foreignKeyExists)) {
            DB::statement('ALTER TABLE student_attendance DROP FOREIGN KEY student_attendance_student_id_foreign');
        }

        // Check if foreign key doesn't exist before adding it
        $foreignKeyExists = DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = DATABASE()
            AND TABLE_NAME = 'student_attendance'
            AND CONSTRAINT_NAME = 'student_attendance_student_id_foreign'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        ");

        if (empty($foreignKeyExists)) {
            DB::statement('ALTER TABLE student_attendance ADD CONSTRAINT student_attendance_student_id_foreign
                FOREIGN KEY (student_id) REFERENCES students(id) ON DELETE CASCADE ON UPDATE CASCADE');
        }
    }

    public function down(): void
    {
        // Skip for SQLite
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        // Check if the foreign key exists before trying to drop it
        $foreignKeyExists = DB::select("
            SELECT CONSTRAINT_NAME
            FROM information_schema.TABLE_CONSTRAINTS
            WHERE CONSTRAINT_SCHEMA = DATABASE()
            AND TABLE_NAME = 'student_attendance'
            AND CONSTRAINT_NAME = 'student_attendance_student_id_foreign'
            AND CONSTRAINT_TYPE = 'FOREIGN KEY'
        ");

        if (!empty($foreignKeyExists)) {
            DB::statement('ALTER TABLE student_attendance DROP FOREIGN KEY student_attendance_student_id_foreign');
        }
    }
};
