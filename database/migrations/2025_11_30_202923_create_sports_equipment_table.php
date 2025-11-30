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
        Schema::create('sports_equipment', function (Blueprint $table) {
            $table->id();

            // Basic Information
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('equipment_type'); // e.g., balls, nets, protective gear, training tools, etc.

            // Quantity & Condition
            $table->integer('quantity')->default(0);
            $table->integer('available_quantity')->default(0);
            $table->enum('condition', ['excellent', 'good', 'fair', 'poor', 'damaged'])->default('good');

            // Purchase & Cost Information
            $table->decimal('purchase_price', 12, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->decimal('replacement_cost', 12, 2)->nullable();

            // Location & Storage
            $table->string('location')->nullable(); // e.g., store room, field house, etc.
            $table->string('storage_area')->nullable();
            $table->foreignId('branch_id')->nullable()->constrained('branches')->onDelete('set null');

            // Status & Maintenance
            $table->enum('status', ['available', 'in_use', 'maintenance', 'retired', 'lost'])->default('available');
            $table->date('maintenance_date')->nullable();
            $table->text('maintenance_notes')->nullable();

            // Additional Information
            $table->string('supplier')->nullable();
            $table->string('reference_code')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports_equipment');
    }
};
