<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations - Add indexes for frequently queried columns.
     */
    public function up(): void
    {
        // Students table indexes
        if (Schema::hasTable('students')) {
            Schema::table('students', function (Blueprint $table) {
                if (!$this->hasIndex('students', 'students_branch_id_index')) {
                    $table->index('branch_id');
                }
                if (!$this->hasIndex('students', 'students_group_id_index')) {
                    $table->index('group_id');
                }
                if (!$this->hasIndex('students', 'students_status_index')) {
                    $table->index('status');
                }
            });
        }

        // Student attendances indexes
        if (Schema::hasTable('student_attendances')) {
            Schema::table('student_attendances', function (Blueprint $table) {
                if (!$this->hasIndex('student_attendances', 'student_attendances_student_id_date_index')) {
                    $table->index(['student_id', 'date']);
                }
                if (!$this->hasIndex('student_attendances', 'student_attendances_date_index')) {
                    $table->index('date');
                }
            });
        }

        // Payments indexes
        if (Schema::hasTable('payments')) {
            Schema::table('payments', function (Blueprint $table) {
                if (!$this->hasIndex('payments', 'payments_status_index')) {
                    $table->index('status');
                }
                if (!$this->hasIndex('payments', 'payments_paid_at_index')) {
                    $table->index('paid_at');
                }
            });
        }

        // Subscriptions indexes
        if (Schema::hasTable('subscriptions')) {
            Schema::table('subscriptions', function (Blueprint $table) {
                if (!$this->hasIndex('subscriptions', 'subscriptions_status_index')) {
                    $table->index('status');
                }
            });
        }

        // Staff tasks indexes
        if (Schema::hasTable('staff_tasks')) {
            Schema::table('staff_tasks', function (Blueprint $table) {
                if (!$this->hasIndex('staff_tasks', 'staff_tasks_status_index')) {
                    $table->index('status');
                }
                if (!$this->hasIndex('staff_tasks', 'staff_tasks_assigned_to_index')) {
                    $table->index('assigned_to');
                }
            });
        }

        // Invoices indexes
        if (Schema::hasTable('invoices')) {
            Schema::table('invoices', function (Blueprint $table) {
                if (!$this->hasIndex('invoices', 'invoices_status_index')) {
                    $table->index('status');
                }
            });
        }

        // Expenses indexes
        if (Schema::hasTable('expenses')) {
            Schema::table('expenses', function (Blueprint $table) {
                if (!$this->hasIndex('expenses', 'expenses_status_index')) {
                    $table->index('status');
                }
                if (!$this->hasIndex('expenses', 'expenses_expense_date_index')) {
                    $table->index('expense_date');
                }
            });
        }

        // Training sessions indexes
        if (Schema::hasTable('training_sessions')) {
            Schema::table('training_sessions', function (Blueprint $table) {
                if (Schema::hasColumn('training_sessions', 'coach_user_id') && !$this->hasIndex('training_sessions', 'training_sessions_coach_user_id_index')) {
                    $table->index('coach_user_id');
                }
                if (Schema::hasColumn('training_sessions', 'branch_id') && !$this->hasIndex('training_sessions', 'training_sessions_branch_id_index')) {
                    $table->index('branch_id');
                }
            });
        }
    }

    /**
     * Check if index exists.
     */
    private function hasIndex(string $table, string $indexName): bool
    {
        $indexes = Schema::getIndexes($table);
        foreach ($indexes as $index) {
            if ($index['name'] === $indexName) {
                return true;
            }
        }
        return false;
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove indexes if needed (optional for performance indexes)
    }
};
