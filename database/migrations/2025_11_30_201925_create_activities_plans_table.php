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
        Schema::create('activities_plans', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->integer('year');
            $table->enum('country', ['Rwanda', 'Tanzania']);
            $table->string('challenge');
            $table->string('opportunity');
            $table->text('baseline');
            $table->text('intervention_objective');
            $table->json('list_of_activities');
            $table->string('kpi');

            // Responsible Person (Staff ID)
            $table->foreignId('responsible_person_id')->constrained('staff')->onDelete('cascade');

            // Focus Area
            $table->enum('focus_area', [
                'Sporting',
                'Administration and Finance',
                'Business',
                'Technology',
                'Capacity Building',
                'Social and Well Being'
            ]);

            // Timeline and Cost
            $table->date('starting_date');
            $table->date('ending_date');
            $table->decimal('cost', 15, 2);
            $table->string('financing_mechanism');

            // Status with color indicators
            $table->enum('status', ['red', 'yellow', 'green']);
            $table->text('status_remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities_plans');
    }
};
