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
        Schema::create('minutes', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->date('date')->nullable();
            $table->time('starting_time')->nullable();
            $table->time('end_time')->nullable();
            $table->string('venue')->nullable();

            // Participants
            $table->string('chaired_by')->nullable();
            $table->string('note_taken_by')->nullable();
            $table->json('attendance_list')->nullable();
            $table->json('absent_apology')->nullable();
            $table->json('absent_no_apology')->nullable();

            // Content
            $table->longText('agenda')->nullable();
            $table->longText('resolution')->nullable();
            $table->string('responsible_person')->nullable();

            // Dates & Status
            $table->date('start_date')->nullable();
            $table->date('competition_date')->nullable();
            $table->enum('status', ['scheduled', 'completed', 'cancelled'])->default('scheduled');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('minutes');
    }
};
