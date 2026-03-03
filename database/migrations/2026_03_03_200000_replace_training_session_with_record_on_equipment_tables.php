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
            // Drop old FK constraints first
            $table->dropForeign(['training_session_id']);
            $table->dropForeign(['inhouse_training_id']);
            $table->dropColumn(['training_session_id', 'inhouse_training_id']);

            // Add new column referencing training_session_records
            $table->unsignedBigInteger('training_record_id')->nullable()->after('id');
            $table->foreign('training_record_id')
                  ->references('id')->on('training_session_records')
                  ->onDelete('cascade');
        });

        // ── equipment_usage_reports ──────────────────────────────────────
        Schema::table('equipment_usage_reports', function (Blueprint $table) {
            $table->dropForeign(['training_session_id']);
            $table->dropForeign(['inhouse_training_id']);
            $table->dropColumn(['training_session_id', 'inhouse_training_id']);

            $table->unsignedBigInteger('training_record_id')->nullable()->after('training_equipment_request_id');
            $table->foreign('training_record_id')
                  ->references('id')->on('training_session_records')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('training_equipment_requests', function (Blueprint $table) {
            $table->dropForeign(['training_record_id']);
            $table->dropColumn('training_record_id');
            $table->unsignedBigInteger('training_session_id')->nullable()->after('id');
            $table->unsignedBigInteger('inhouse_training_id')->nullable();
            $table->foreign('training_session_id')->references('id')->on('training_sessions')->onDelete('cascade');
            $table->foreign('inhouse_training_id')->references('id')->on('inhouse_trainings')->onDelete('cascade');
        });

        Schema::table('equipment_usage_reports', function (Blueprint $table) {
            $table->dropForeign(['training_record_id']);
            $table->dropColumn('training_record_id');
            $table->unsignedBigInteger('training_session_id')->nullable()->after('training_equipment_request_id');
            $table->unsignedBigInteger('inhouse_training_id')->nullable();
            $table->foreign('training_session_id')->references('id')->on('training_sessions')->onDelete('cascade');
            $table->foreign('inhouse_training_id')->references('id')->on('inhouse_trainings')->onDelete('cascade');
        });
    }
};
