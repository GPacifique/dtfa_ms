<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('staff_tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable();
            $table->string('status')->default('open');
            $table->date('due_date')->nullable();
            $table->string('priority')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff_tasks');
    }
};
