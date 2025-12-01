<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('training_session_records', function (Blueprint $table) {
            if (!Schema::hasColumn('training_session_records', 'coach_id')) {
                $table->unsignedBigInteger('coach_id')->nullable()->after('id');
                // Add FK to users if table exists
                if (Schema::hasTable('users')) {
                    $table->foreign('coach_id')->references('id')->on('users')->nullOnDelete();
                }
            }
        });
    }

    public function down()
    {
        Schema::table('training_session_records', function (Blueprint $table) {
            if (Schema::hasColumn('training_session_records', 'coach_id')) {
                try {
                    $table->dropForeign(['coach_id']);
                } catch (\Throwable $e) {
                    // ignore if foreign key doesn't exist
                }
                $table->dropColumn('coach_id');
            }
        });
    }
};
