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
        Schema::create('income_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('color', 7)->default('#10B981'); // Hex color for UI
            $table->string('icon')->nullable(); // Icon name for UI
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Seed default income categories
        $categories = [
            ['name' => 'Training Fees', 'slug' => 'training_fees', 'color' => '#10B981', 'icon' => 'academic-cap'],
            ['name' => 'Registration Fees', 'slug' => 'registration_fees', 'color' => '#3B82F6', 'icon' => 'user-plus'],
            ['name' => 'Jersey Sales', 'slug' => 'jersey_sales', 'color' => '#8B5CF6', 'icon' => 'shirt'],
            ['name' => 'Equipment Sales', 'slug' => 'equipment_sales', 'color' => '#F59E0B', 'icon' => 'cube'],
            ['name' => 'Tournament Fees', 'slug' => 'tournament_fees', 'color' => '#EF4444', 'icon' => 'trophy'],
            ['name' => 'Sponsorship', 'slug' => 'sponsorship', 'color' => '#EC4899', 'icon' => 'star'],
            ['name' => 'Donations', 'slug' => 'donations', 'color' => '#06B6D4', 'icon' => 'gift'],
            ['name' => 'Grants', 'slug' => 'grants', 'color' => '#84CC16', 'icon' => 'banknotes'],
            ['name' => 'Match Revenue', 'slug' => 'match_revenue', 'color' => '#F97316', 'icon' => 'ticket'],
            ['name' => 'Facility Rental', 'slug' => 'facility_rental', 'color' => '#14B8A6', 'icon' => 'building-office'],
            ['name' => 'Merchandise', 'slug' => 'merchandise', 'color' => '#A855F7', 'icon' => 'shopping-bag'],
            ['name' => 'Consultation Fees', 'slug' => 'consultation_fees', 'color' => '#6366F1', 'icon' => 'chat-bubble-left-right'],
            ['name' => 'Late Payment Fees', 'slug' => 'late_payment_fees', 'color' => '#DC2626', 'icon' => 'clock'],
            ['name' => 'Refunds Received', 'slug' => 'refunds_received', 'color' => '#22C55E', 'icon' => 'arrow-uturn-left'],
            ['name' => 'Interest Income', 'slug' => 'interest_income', 'color' => '#0EA5E9', 'icon' => 'chart-bar'],
            ['name' => 'Other', 'slug' => 'other', 'color' => '#9CA3AF', 'icon' => 'ellipsis-horizontal'],
        ];

        foreach ($categories as $index => $cat) {
            DB::table('income_categories')->insert([
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
        Schema::dropIfExists('income_categories');
    }
};
