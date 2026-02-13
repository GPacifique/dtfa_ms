<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('form_submissions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable()->index();
            $table->string('form_type'); // contact, complaint, feedback, etc.
            $table->string('subject')->nullable();
            $table->text('message');
            $table->json('form_data')->nullable(); // Store additional form fields as JSON
            $table->string('status')->default('received'); // received, read, acknowledged, resolved
            $table->text('notes')->nullable();
            $table->unsignedBigInteger('assigned_to')->nullable()->index(); // Staff member assigned
            $table->timestamp('read_at')->nullable();
            $table->timestamp('responded_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('assigned_to')->references('id')->on('staff')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_submissions');
    }
};
