<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment_usage_reports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('training_equipment_request_id');
            $table->unsignedBigInteger('training_session_id')->nullable();
            $table->unsignedBigInteger('inhouse_training_id')->nullable();
            $table->string('equipment_type'); // 'general', 'sports', 'office'
            $table->unsignedBigInteger('equipment_id');
            $table->integer('quantity_used')->default(0);
            $table->integer('quantity_returned')->default(0);
            $table->integer('quantity_damaged')->default(0);
            $table->integer('quantity_lost')->default(0);
            $table->enum('equipment_condition_after', ['excellent', 'good', 'fair', 'poor', 'damaged'])->default('good');
            $table->text('usage_summary')->nullable();
            $table->text('issues_encountered')->nullable();
            $table->text('recommendations')->nullable();
            $table->unsignedBigInteger('reported_by')->nullable();
            $table->timestamp('reported_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('training_equipment_request_id')->references('id')->on('training_equipment_requests')->onDelete('cascade');
            $table->foreign('training_session_id')->references('id')->on('training_sessions')->onDelete('set null');
            $table->foreign('inhouse_training_id')->references('id')->on('inhouse_trainings')->onDelete('set null');
            $table->foreign('reported_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment_usage_reports');
    }
};
