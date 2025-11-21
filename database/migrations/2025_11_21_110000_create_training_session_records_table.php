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
            $table->unsignedBigInteger('coach_id')->nullable();
            $table->string('coach_name')->nullable();
            $table->string('branch')->nullable(); // Rwanda/Tanzania
            $table->string('training_pitch')->nullable();
            $table->date('date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('finish_time')->nullable();
            $table->string('main_topic')->nullable();
            $table->string('area_performance')->nullable();
            $table->text('part1_activities')->nullable();
            $table->text('part2_activities')->nullable();
            $table->text('part3_notes')->nullable();
            $table->text('part4_message')->nullable();
            $table->integer('number_of_kids')->nullable();
            $table->text('incident_report')->nullable();
            $table->text('missed_damaged_equipment')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('training_session_records');
    }
};

