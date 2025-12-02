<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('inhouse_trainings', function (Blueprint $table) {
            $table->id();

            // Basic personal info
            $table->string('first_name')->nullable();
            $table->string('second_name')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();

            // Location
            $table->enum('country', ['Rwanda', 'Tanzania'])->default('Rwanda');
            $table->enum('city', ['Kigali', 'Mwanza'])->default('Kigali');

            // Discipline
            $table->enum('discipline', ['Football', 'BasketBall'])->default('Football');

            // Relations
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();

            // Training details
            $table->string('training_name')->nullable();
            $table->string('channel')->nullable();
            $table->date('training_date')->nullable();
            $table->dateTime('start')->nullable();
            $table->dateTime('end')->nullable();

            $table->enum('cost', ['Free', 'Paid'])->default('Paid');

            $table->text('notes')->nullable();

            $table->enum('training_category', ['In house', 'Outside DTFA'])->default('In house');
            $table->string('venue')->nullable();
            $table->string('location')->nullable();
            $table->string('trainer_name')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('inhouse_trainings');
    }
};
