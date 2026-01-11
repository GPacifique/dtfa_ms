<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add expense_category_id to expenses table
        Schema::table('expenses', function (Blueprint $table) {
            $table->foreignId('expense_category_id')
                ->nullable()
                ->after('user_id')
                ->constrained('expense_categories')
                ->nullOnDelete();
        });

        // Migrate existing category strings to category IDs
        $expenses = DB::table('expenses')->whereNotNull('category')->get();
        foreach ($expenses as $expense) {
            $category = DB::table('expense_categories')
                ->where('slug', $expense->category)
                ->orWhere('name', $expense->category)
                ->first();

            if ($category) {
                DB::table('expenses')
                    ->where('id', $expense->id)
                    ->update(['expense_category_id' => $category->id]);
            } else {
                // Assign to "Other" category if not found
                $otherCat = DB::table('expense_categories')->where('slug', 'other')->first();
                if ($otherCat) {
                    DB::table('expenses')
                        ->where('id', $expense->id)
                        ->update(['expense_category_id' => $otherCat->id]);
                }
            }
        }

        // Add income_category_id to incomes table
        Schema::table('incomes', function (Blueprint $table) {
            $table->foreignId('income_category_id')
                ->nullable()
                ->after('branch_id')
                ->constrained('income_categories')
                ->nullOnDelete();
        });

        // Migrate existing category strings to category IDs for incomes
        $incomes = DB::table('incomes')->whereNotNull('category')->get();
        foreach ($incomes as $income) {
            $category = DB::table('income_categories')
                ->where('slug', $income->category)
                ->orWhere('name', $income->category)
                ->first();

            if ($category) {
                DB::table('incomes')
                    ->where('id', $income->id)
                    ->update(['income_category_id' => $category->id]);
            } else {
                // Assign to "Other" category if not found
                $otherCat = DB::table('income_categories')->where('slug', 'other')->first();
                if ($otherCat) {
                    DB::table('incomes')
                        ->where('id', $income->id)
                        ->update(['income_category_id' => $otherCat->id]);
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('expenses', function (Blueprint $table) {
            $table->dropForeign(['expense_category_id']);
            $table->dropColumn('expense_category_id');
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->dropForeign(['income_category_id']);
            $table->dropColumn('income_category_id');
        });
    }
};
