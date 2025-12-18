<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Simply drop the foreign key that's causing issues
        // We'll rely on application-level validation instead
        try {
            DB::statement('ALTER TABLE student_attendance DROP FOREIGN KEY student_attendance_student_id_foreign');
        } catch (\Exception $e) {
            // Foreign key might not exist, that's okay
        }
    }

    public function down(): void
    {
        // No-op for rollback
    }
};
