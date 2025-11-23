<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        Schema::table('training_session_records', function (Blueprint $table) {
            if (!Schema::hasColumn('training_session_records', 'part4_message')) {
                $table->text('part4_message')->nullable();
            }
        });

        try {
            if (Schema::hasColumn('training_session_records', 'part_4_message')) {
                DB::statement('UPDATE `training_session_records` SET `part4_message` = `part_4_message` WHERE (`part4_message` IS NULL OR `part4_message` = "")');
            }
        } catch (\Throwable $e) {
            // ignore
        }
    }

    public function down()
    {
        Schema::table('training_session_records', function (Blueprint $table) {
            if (Schema::hasColumn('training_session_records', 'part4_message')) {
                $table->dropColumn('part4_message');
            }
        });
    }
};
