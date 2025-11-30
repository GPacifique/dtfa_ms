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
        Schema::create('upcoming_events', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('event_name')->nullable();
            $table->date('date')->nullable();
            $table->string('venue')->nullable();
            $table->time('starting_time')->nullable();
            $table->time('ending_time')->nullable();

            // Content
            $table->longText('objective')->nullable();
            $table->longText('targeted_audience')->nullable();

            // Coordinator & Staff
            $table->string('coordinator_name')->nullable();
            $table->json('supporting_staff_names')->nullable();

            // Payment
            $table->boolean('is_paid')->default(false);
            $table->decimal('amount', 10, 2)->nullable();
            $table->string('currency')->default('RWF');

            // Status
            $table->enum('status', ['upcoming', 'ongoing', 'completed', 'cancelled'])->default('upcoming');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('upcoming_events');
    }
};
