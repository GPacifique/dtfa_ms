<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('training_session_records', function (Blueprint $table) {
            // structured Part 1 fields
            if (!Schema::hasColumn('training_session_records', 'part1_a1_desc')) {
                $table->text('part1_a1_desc')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part1_a1_time')) {
                $table->string('part1_a1_time')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part1_a2_desc')) {
                $table->text('part1_a2_desc')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part1_a2_time')) {
                $table->string('part1_a2_time')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part1_a3_desc')) {
                $table->text('part1_a3_desc')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part1_a3_time')) {
                $table->string('part1_a3_time')->nullable();
            }

            // structured Part 2 fields
            if (!Schema::hasColumn('training_session_records', 'part2_a1_desc')) {
                $table->text('part2_a1_desc')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part2_a1_time')) {
                $table->string('part2_a1_time')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part2_a2_desc')) {
                $table->text('part2_a2_desc')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part2_a2_time')) {
                $table->string('part2_a2_time')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part2_a3_desc')) {
                $table->text('part2_a3_desc')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part2_a3_time')) {
                $table->string('part2_a3_time')->nullable();
            }

            // comments / report
            if (!Schema::hasColumn('training_session_records', 'comments')) {
                $table->text('comments')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('training_session_records', function (Blueprint $table) {
            $cols = [
                'part1_a1_desc','part1_a1_time','part1_a2_desc','part1_a2_time','part1_a3_desc','part1_a3_time',
                'part2_a1_desc','part2_a1_time','part2_a2_desc','part2_a2_time','part2_a3_desc','part2_a3_time',
                'comments'
            ];
            foreach ($cols as $c) {
                if (Schema::hasColumn('training_session_records', $c)) {
                    $table->dropColumn($c);
                }
            }
        });
    }
};
