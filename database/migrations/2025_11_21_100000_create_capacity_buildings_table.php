<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('capacity_buildings', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('second_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('branch')->nullable();
            $table->string('role_function')->nullable();
            $table->string('training_name');
            $table->string('institution_name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('channel')->nullable(); // e.g., Face to face or Virtual
            $table->string('cost_type')->default('free'); // free or paid
            $table->decimal('cost_amount', 12, 2)->nullable();
            $table->string('training_category')->nullable(); // in house or outside DTFA
            $table->string('venue')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('capacity_buildings');
    }
};
