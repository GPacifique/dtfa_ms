<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('training_session_records', function (Blueprint $table) {
            if (! Schema::hasColumn('training_session_records', 'branch_id')) {
                $table->foreignId('branch_id')
                      ->nullable()
                      ->after('id')
                      ->constrained('branches')
                      ->nullOnDelete();
            }
        });

        // Back-fill branch_id from the existing string `branch` column
        // by matching the Branch name (case-insensitive).
        DB::statement('
            UPDATE training_session_records tsr
            INNER JOIN branches b ON LOWER(TRIM(b.name)) = LOWER(TRIM(tsr.branch))
            SET tsr.branch_id = b.id
            WHERE tsr.branch_id IS NULL
              AND tsr.branch IS NOT NULL
              AND tsr.branch <> ""
        ');
    }

    public function down(): void
    {
        Schema::table('training_session_records', function (Blueprint $table) {
            if (Schema::hasColumn('training_session_records', 'branch_id')) {
                $table->dropConstrainedForeignId('branch_id');
            }
        });
    }
};
