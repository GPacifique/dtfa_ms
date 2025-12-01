<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('students', function (Blueprint $table) {
            // Add indexes to common filterable columns if not present
            if (!Schema::hasColumn('students', 'status')) {
                // status exists based on earlier migrations; this guard prevents errors in odd states
                $table->string('status')->default('active');
            }
            $table->index('status', 'students_status_idx');
            if (Schema::hasColumn('students', 'branch_id')) {
                $table->index('branch_id', 'students_branch_idx');
            }
            if (Schema::hasColumn('students', 'group_id')) {
                $table->index('group_id', 'students_group_idx');
            }
            if (Schema::hasColumn('students', 'joined_at')) {
                $table->index('joined_at', 'students_joined_at_idx');
            }
        });
    }

    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            // Drop indexes if they exist
            try { $table->dropIndex('students_status_idx'); } catch (\Throwable $e) {}
            try { $table->dropIndex('students_branch_idx'); } catch (\Throwable $e) {}
            try { $table->dropIndex('students_group_idx'); } catch (\Throwable $e) {}
            try { $table->dropIndex('students_joined_at_idx'); } catch (\Throwable $e) {}
        });
    }
};
