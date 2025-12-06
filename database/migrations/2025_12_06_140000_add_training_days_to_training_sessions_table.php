<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('training_sessions')) {
            Schema::table('training_sessions', function (Blueprint $table) {
                // Add training_days as JSON array to store selected days (Monday-Sunday)
                if (!Schema::hasColumn('training_sessions', 'training_days')) {
                    $table->json('training_days')->nullable()->after('location')->comment('Array of selected training days (Monday to Sunday)');
                }
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('training_sessions') && Schema::hasColumn('training_sessions', 'training_days')) {
            Schema::table('training_sessions', function (Blueprint $table) {
                $table->dropColumn('training_days');
            });
        }
    }
};
