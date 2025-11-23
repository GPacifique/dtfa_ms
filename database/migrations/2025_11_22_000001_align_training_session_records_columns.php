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
            // add new columns expected by application if they don't exist
            if (!Schema::hasColumn('training_session_records', 'training_pitch')) {
                $table->string('training_pitch')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'area_performance')) {
                $table->string('area_performance')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part1_activities')) {
                $table->text('part1_activities')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part2_activities')) {
                $table->text('part2_activities')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'part3_notes')) {
                $table->text('part3_notes')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'number_of_kids')) {
                $table->integer('number_of_kids')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'incident_report')) {
                $table->text('incident_report')->nullable();
            }
            if (!Schema::hasColumn('training_session_records', 'missed_damaged_equipment')) {
                $table->text('missed_damaged_equipment')->nullable();
            }
        });

        // copy data from legacy columns if present
        try {
            // pitch -> training_pitch
            if (Schema::hasColumn('training_session_records', 'pitch')) {
                DB::statement('UPDATE `training_session_records` SET `training_pitch` = `pitch` WHERE `training_pitch` IS NULL OR `training_pitch` = "" ');
            }

            // area_of_performance -> area_performance
            if (Schema::hasColumn('training_session_records', 'area_of_performance')) {
                DB::statement('UPDATE `training_session_records` SET `area_performance` = `area_of_performance` WHERE `area_performance` IS NULL OR `area_performance` = "" ');
            }

            // part_1_details/part_2_details/part_3_details -> part1_activities/part2_activities/part3_notes
            if (Schema::hasColumn('training_session_records', 'part_1_details')) {
                DB::statement('UPDATE `training_session_records` SET `part1_activities` = `part_1_details` WHERE (`part1_activities` IS NULL OR `part1_activities` = "")');
            }
            if (Schema::hasColumn('training_session_records', 'part_2_details')) {
                DB::statement('UPDATE `training_session_records` SET `part2_activities` = `part_2_details` WHERE (`part2_activities` IS NULL OR `part2_activities` = "")');
            }
            if (Schema::hasColumn('training_session_records', 'part_3_details')) {
                DB::statement('UPDATE `training_session_records` SET `part3_notes` = `part_3_details` WHERE (`part3_notes` IS NULL OR `part3_notes` = "")');
            }

            // part_4_message exists already but keep safe

            // attendees_count -> number_of_kids
            if (Schema::hasColumn('training_session_records', 'attendees_count')) {
                DB::statement('UPDATE `training_session_records` SET `number_of_kids` = `attendees_count` WHERE (`number_of_kids` IS NULL)');
            }

            // incidents -> incident_report
            if (Schema::hasColumn('training_session_records', 'incidents')) {
                DB::statement('UPDATE `training_session_records` SET `incident_report` = `incidents` WHERE (`incident_report` IS NULL OR `incident_report` = "")');
            }

            // equipment_issues -> missed_damaged_equipment
            if (Schema::hasColumn('training_session_records', 'equipment_issues')) {
                DB::statement('UPDATE `training_session_records` SET `missed_damaged_equipment` = `equipment_issues` WHERE (`missed_damaged_equipment` IS NULL OR `missed_damaged_equipment` = "")');
            }
        } catch (\Throwable $e) {
            // ignore copying errors in case columns are missing or DB user lacks privileges
        }
    }

    public function down()
    {
        Schema::table('training_session_records', function (Blueprint $table) {
            if (Schema::hasColumn('training_session_records', 'training_pitch')) {
                $table->dropColumn('training_pitch');
            }
            if (Schema::hasColumn('training_session_records', 'area_performance')) {
                $table->dropColumn('area_performance');
            }
            if (Schema::hasColumn('training_session_records', 'part1_activities')) {
                $table->dropColumn('part1_activities');
            }
            if (Schema::hasColumn('training_session_records', 'part2_activities')) {
                $table->dropColumn('part2_activities');
            }
            if (Schema::hasColumn('training_session_records', 'part3_notes')) {
                $table->dropColumn('part3_notes');
            }
            if (Schema::hasColumn('training_session_records', 'number_of_kids')) {
                $table->dropColumn('number_of_kids');
            }
            if (Schema::hasColumn('training_session_records', 'incident_report')) {
                $table->dropColumn('incident_report');
            }
            if (Schema::hasColumn('training_session_records', 'missed_damaged_equipment')) {
                $table->dropColumn('missed_damaged_equipment');
            }
        });
    }
};
