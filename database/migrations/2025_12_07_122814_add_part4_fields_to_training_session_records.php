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
        Schema::table('training_session_records', function (Blueprint $table) {
            $table->text('part4_a1_desc')->nullable();
            $table->string('part4_a1_time')->nullable();
            $table->text('part4_a2_desc')->nullable();
            $table->string('part4_a2_time')->nullable();
            $table->text('part4_a3_desc')->nullable();
            $table->string('part4_a3_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('training_session_records', function (Blueprint $table) {
            $table->dropColumn(['part4_a1_desc', 'part4_a1_time', 'part4_a2_desc', 'part4_a2_time', 'part4_a3_desc', 'part4_a3_time']);
        });
    }
};
