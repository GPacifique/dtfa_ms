<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('staff_attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('staff_id')->nullable();
            $table->string('activity_type')->nullable();
            $table->date('date')->nullable();
            $table->string('status')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_attendances');
    }
};
