<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('training_session_records')) {
            Schema::table('training_session_records', function (Blueprint $table) {
                // Add training_days as JSON array to store selected days (Monday-Sunday)
                if (!Schema::hasColumn('training_session_records', 'training_days')) {
                    $table->json('training_days')->nullable()->after('date')->comment('Array of selected training days (Monday to Sunday)');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('training_session_records') && Schema::hasColumn('training_session_records', 'training_days')) {
            Schema::table('training_session_records', function (Blueprint $table) {
                $table->dropColumn('training_days');
            });
        }
    }
};
