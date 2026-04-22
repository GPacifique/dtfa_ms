<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            // Link to student
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();

            // Optional: who recorded the payment (admin/coach)
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();

            $table->decimal('amount', 10, 2);

            $table->enum('method', ['cash', 'mobile_money', 'card'])->default('cash');

            $table->enum('status', ['paid', 'pending'])->default('paid');

            $table->date('paid_at')->nullable();

            $table->string('reference')->nullable(); // for MoMo / transaction ID

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};