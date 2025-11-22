<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('communications', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body')->nullable();
            $table->unsignedBigInteger('sender_id')->nullable();
            $table->text('minutes')->nullable();
            $table->string('activity_type')->nullable();
            $table->string('audience')->default('staff'); // staff | all
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('communications');
    }
};
