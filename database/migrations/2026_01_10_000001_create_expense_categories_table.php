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
        Schema::create('expense_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('color', 7)->default('#6B7280'); // Hex color for UI
            $table->string('icon')->nullable(); // Icon name for UI
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Seed default expense categories
        $categories = [
            ['name' => 'Transport', 'slug' => 'transport', 'color' => '#3B82F6', 'icon' => 'truck'],
            ['name' => 'Communication', 'slug' => 'communication', 'color' => '#8B5CF6', 'icon' => 'phone'],
            ['name' => 'Repair and Maintenance', 'slug' => 'repair_maintenance', 'color' => '#EF4444', 'icon' => 'wrench'],
            ['name' => 'Electricity', 'slug' => 'electricity', 'color' => '#F59E0B', 'icon' => 'bolt'],
            ['name' => 'Internet', 'slug' => 'internet', 'color' => '#06B6D4', 'icon' => 'wifi'],
            ['name' => 'Website', 'slug' => 'website', 'color' => '#10B981', 'icon' => 'globe'],
            ['name' => 'Medical and Physio', 'slug' => 'medical_physio', 'color' => '#EC4899', 'icon' => 'heart'],
            ['name' => 'Printing', 'slug' => 'printing', 'color' => '#6366F1', 'icon' => 'printer'],
            ['name' => 'MoMo Charges', 'slug' => 'momo_charges', 'color' => '#FBBF24', 'icon' => 'credit-card'],
            ['name' => 'Kids Jersey', 'slug' => 'kids_jersey', 'color' => '#34D399', 'icon' => 'shirt'],
            ['name' => 'Loans', 'slug' => 'loans', 'color' => '#F87171', 'icon' => 'banknotes'],
            ['name' => 'Salary', 'slug' => 'salary', 'color' => '#4ADE80', 'icon' => 'users'],
            ['name' => 'Salary Advance', 'slug' => 'salary_advance', 'color' => '#A78BFA', 'icon' => 'arrow-trending-up'],
            ['name' => 'Capacity Building', 'slug' => 'capacity_building', 'color' => '#FB923C', 'icon' => 'academic-cap'],
            ['name' => 'Office Supplies', 'slug' => 'office_supplies', 'color' => '#38BDF8', 'icon' => 'clipboard'],
            ['name' => 'Office Cleaning', 'slug' => 'office_cleaning', 'color' => '#2DD4BF', 'icon' => 'sparkles'],
            ['name' => 'Cleaning Supplies', 'slug' => 'cleaning_supplies', 'color' => '#818CF8', 'icon' => 'beaker'],
            ['name' => 'Equipments', 'slug' => 'equipments', 'color' => '#FB7185', 'icon' => 'cube'],
            ['name' => 'Management System', 'slug' => 'management_system', 'color' => '#C084FC', 'icon' => 'server'],
            ['name' => 'Invoice', 'slug' => 'invoice', 'color' => '#FCD34D', 'icon' => 'document-text'],
            ['name' => 'Other', 'slug' => 'other', 'color' => '#9CA3AF', 'icon' => 'ellipsis-horizontal'],
        ];

        foreach ($categories as $index => $cat) {
            DB::table('expense_categories')->insert([
                'name' => $cat['name'],
                'slug' => $cat['slug'],
                'color' => $cat['color'],
                'icon' => $cat['icon'],
                'is_active' => true,
                'sort_order' => $index,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expense_categories');
    }
};
