<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('training_session_records', function (Blueprint $table) {

            $table->id();

            // Basic details
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('finish_time')->nullable();
            $table->string('coach_name')->nullable();
            $table->string('branch')->nullable();
            $table->enum('training_pitch', ['IPRC Kicukiro- Football', 'Green Hills Academy', 'Star School -Masaka', 'Nyamagana Stadium', 'IPRC-Kigali -Basketball'])->nullable();

            // The missing fields causing your error
            $table->string('country')->nullable();
            $table->string('city')->nullable();

            // Discipline and training details
            $table->string('sport_discipline')->nullable();
            $table->string('other_training_pitch')->nullable();
            $table->text('main_topic')->nullable();
            $table->string('area_performance')->nullable();
            $table->text('training_objective')->nullable();

            // Part 1 fields
            $table->text('part1_activities')->nullable();
            $table->text('part1_a1_desc')->nullable();
            $table->string('part1_a1_time')->nullable();
            $table->text('part1_a2_desc')->nullable();
            $table->string('part1_a2_time')->nullable();
            $table->text('part1_a3_desc')->nullable();
            $table->string('part1_a3_time')->nullable();

            // Part 2 fields
            $table->text('part2_activities')->nullable();
            $table->text('part2_a1_desc')->nullable();
            $table->string('part2_a1_time')->nullable();
            $table->text('part2_a2_desc')->nullable();
            $table->string('part2_a2_time')->nullable();
            $table->text('part2_a3_desc')->nullable();
            $table->string('part2_a3_time')->nullable();

            // Notes, kids, incidents, comments
            $table->text('part3_notes')->nullable();
            $table->text('part4_message')->nullable();
            $table->integer('number_of_kids')->nullable();
            $table->text('incident_report')->nullable();
            $table->text('missed_damaged_equipment')->nullable();
            $table->text('comments')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_session_records');
    }
};
