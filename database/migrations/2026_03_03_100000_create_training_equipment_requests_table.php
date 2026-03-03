<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('training_equipment_requests', function (Blueprint $table) {
            $table->id();
            // Can belong to either a TrainingSession or InhouseTraining
            $table->unsignedBigInteger('training_session_id')->nullable();
            $table->unsignedBigInteger('inhouse_training_id')->nullable();
            // Polymorphic equipment reference
            $table->string('equipment_type'); // 'general', 'sports', 'office'
            $table->unsignedBigInteger('equipment_id');
            $table->integer('quantity_requested')->default(1);
            $table->integer('quantity_approved')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'fulfilled', 'returned'])->default('pending');
            $table->text('purpose')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('requested_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('training_session_id')->references('id')->on('training_sessions')->onDelete('cascade');
            $table->foreign('inhouse_training_id')->references('id')->on('inhouse_trainings')->onDelete('cascade');
            $table->foreign('requested_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_equipment_requests');
    }
};
