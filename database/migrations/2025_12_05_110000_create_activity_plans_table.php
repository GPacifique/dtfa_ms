<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('activity_plans')) {
            Schema::create('activity_plans', function (Blueprint $table) {
                $table->id();
                $table->integer('year');
                $table->enum('country', ['Rwanda', 'Tanzania']);
                $table->string('challenge');
                $table->string('opportunity');
                $table->text('baseline');
                $table->text('intervention_objective');
                $table->json('list_of_activities');
                $table->string('kpi');
                $table->foreignId('responsible_person_id')->constrained('staff');
                $table->enum('focus_area', ['Sporting','Administration and Finance','Business','Technology','Capacity Building','Social and Well Being']);
                $table->date('starting_date');
                $table->date('ending_date');
                $table->decimal('cost', 12, 2);
                $table->string('financing_mechanism');
                $table->enum('status', ['red','yellow','green'])->default('yellow');
                $table->text('status_remarks')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_plans');
    }
};
