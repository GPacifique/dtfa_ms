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
        // Step 1: Consolidate image_path into photo_path where photo_path is null
        \DB::statement('
            UPDATE students
            SET photo_path = image_path
            WHERE photo_path IS NULL AND image_path IS NOT NULL
        ');

        // Step 2: Drop the legacy image_path column
        Schema::table('students', function (Blueprint $table) {
            if (Schema::hasColumn('students', 'image_path')) {
                $table->dropColumn('image_path');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Restore the image_path column (optional, for rollback)
        Schema::table('students', function (Blueprint $table) {
            if (!Schema::hasColumn('students', 'image_path')) {
                $table->string('image_path')->nullable()->after('status');
            }
        });

        // Optionally restore data (not recommended in production)
        // \DB::statement('UPDATE students SET image_path = photo_path WHERE image_path IS NULL');
    }
};
