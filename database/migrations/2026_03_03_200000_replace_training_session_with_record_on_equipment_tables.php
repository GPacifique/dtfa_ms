<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── training_equipment_requests ──────────────────────────────────
        Schema::table('training_equipment_requests', function (Blueprint $table) {
            try { $table->dropForeign(['training_session_id']); } catch (\Throwable $e) {}
            try { $table->dropForeign(['inhouse_training_id']); } catch (\Throwable $e) {}
        });

        Schema::table('training_equipment_requests', function (Blueprint $table) {
            $colsToDrop = array_filter(
                ['training_session_id', 'inhouse_training_id'],
                fn($col) => Schema::hasColumn('training_equipment_requests', $col)
            );
            if (!empty($colsToDrop)) {
                $table->dropColumn(array_values($colsToDrop));
            }

            if (!Schema::hasColumn('training_equipment_requests', 'training_record_id')) {
                $table->unsignedBigInteger('training_record_id')->nullable()->after('id');
                $table->foreign('training_record_id')
                      ->references('id')->on('training_session_records')
                      ->onDelete('cascade');
            }
        });

        // ── equipment_usage_reports ──────────────────────────────────────
        Schema::table('equipment_usage_reports', function (Blueprint $table) {
            try { $table->dropForeign(['training_session_id']); } catch (\Throwable $e) {}
            try { $table->dropForeign(['inhouse_training_id']); } catch (\Throwable $e) {}
        });

        Schema::table('equipment_usage_reports', function (Blueprint $table) {
            $colsToDrop = array_filter(
                ['training_session_id', 'inhouse_training_id'],
                fn($col) => Schema::hasColumn('equipment_usage_reports', $col)
            );
            if (!empty($colsToDrop)) {
                $table->dropColumn(array_values($colsToDrop));
            }

            if (!Schema::hasColumn('equipment_usage_reports', 'training_record_id')) {
                $table->unsignedBigInteger('training_record_id')->nullable()->after('training_equipment_request_id');
                $table->foreign('training_record_id')
                      ->references('id')->on('training_session_records')
                      ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('training_equipment_requests', function (Blueprint $table) {
            try { $table->dropForeign(['training_record_id']); } catch (\Throwable $e) {}
        });

        Schema::table('training_equipment_requests', function (Blueprint $table) {
            if (Schema::hasColumn('training_equipment_requests', 'training_record_id')) {
                $table->dropColumn('training_record_id');
            }
            if (!Schema::hasColumn('training_equipment_requests', 'training_session_id')) {
                $table->unsignedBigInteger('training_session_id')->nullable()->after('id');
                $table->foreign('training_session_id')->references('id')->on('training_sessions')->onDelete('cascade');
            }
            if (!Schema::hasColumn('training_equipment_requests', 'inhouse_training_id')) {
                $table->unsignedBigInteger('inhouse_training_id')->nullable();
                $table->foreign('inhouse_training_id')->references('id')->on('inhouse_trainings')->onDelete('cascade');
            }
        });

        Schema::table('equipment_usage_reports', function (Blueprint $table) {
            try { $table->dropForeign(['training_record_id']); } catch (\Throwable $e) {}
        });

        Schema::table('equipment_usage_reports', function (Blueprint $table) {
            if (Schema::hasColumn('equipment_usage_reports', 'training_record_id')) {
                $table->dropColumn('training_record_id');
            }
            if (!Schema::hasColumn('equipment_usage_reports', 'training_session_id')) {
                $table->unsignedBigInteger('training_session_id')->nullable()->after('training_equipment_request_id');
                $table->foreign('training_session_id')->references('id')->on('training_sessions')->onDelete('cascade');
            }
            if (!Schema::hasColumn('equipment_usage_reports', 'inhouse_training_id')) {
                $table->unsignedBigInteger('inhouse_training_id')->nullable();
                $table->foreign('inhouse_training_id')->references('id')->on('inhouse_trainings')->onDelete('cascade');
            }
        });
    }
};
