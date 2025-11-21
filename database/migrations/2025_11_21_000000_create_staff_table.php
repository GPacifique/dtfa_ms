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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->enum('branch', ['RWANDA', 'TANZANIA'])->nullable();
            $table->enum('discipline', ['Football', 'Basketball'])->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->date('dob')->nullable();
            $table->string('role_function')->nullable();
            $table->date('date_entry')->nullable();
            $table->date('date_exit')->nullable();
            $table->text('other_organizations')->nullable();
            $table->text('academic_qualification')->nullable();
            $table->string('major')->nullable();
            $table->text('professional_certificates')->nullable();
            $table->string('tshirt_size')->nullable();
            $table->string('short_size')->nullable();
            $table->string('top_tracksuit_size')->nullable();
            $table->string('pant_tracksuit_size')->nullable();
            $table->string('email')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
