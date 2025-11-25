<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('dob')->nullable(); // Date of Birth
            $table->string('gender', 10)->nullable(); // Gender (Max 10 chars)
            $table->foreignId('parent_user_id')->nullable()->constrained('users')->nullOnDelete(); // Foreign key to users table
            $table->string('phone')->nullable(); // Optional phone number
            $table->string('status')->default('active'); // Default status is 'active'
            $table->timestamp('joined_at')->nullable(); // Optional date for when the student joined
            $table->timestamps(); // Automatically adds created_at and updated_at columns
        });
    }

    public function down(): void
    {
        // Drop the students table if the migration is rolled back
        Schema::dropIfExists('students');
    }
};
