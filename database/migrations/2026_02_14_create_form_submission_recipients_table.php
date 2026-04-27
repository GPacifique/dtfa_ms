<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('form_submission_recipients')) {
            Schema::create('form_submission_recipients', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('form_submission_id')->index();
                $table->string('recipient_email');
                $table->string('recipient_type'); // staff or user
                $table->timestamp('sent_at')->nullable();
                $table->timestamp('delivered_at')->nullable();
                $table->timestamp('opened_at')->nullable();
                $table->text('error_message')->nullable();
                $table->integer('retry_count')->default(0);
                $table->timestamps();

                // Foreign key constraint
                $table->foreign('form_submission_id')->references('id')->on('form_submissions')->onDelete('cascade');
            });
        }
    }

    public function down()
    {
        if (Schema::hasTable('form_submission_recipients')) {
            Schema::dropIfExists('form_submission_recipients');
        }
    }
};
