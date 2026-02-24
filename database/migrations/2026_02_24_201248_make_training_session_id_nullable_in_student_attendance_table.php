<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('student_attendance', function (Blueprint $table) {
            // Check if training_session_id column exists before modifying
            if (Schema::hasColumn('student_attendance', 'training_session_id')) {
                $table->unsignedBigInteger('training_session_id')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_attendance', function (Blueprint $table) {
            if (Schema::hasColumn('student_attendance', 'training_session_id')) {
                $table->unsignedBigInteger('training_session_id')->nullable(false)->change();
            }
        });
    }
};
