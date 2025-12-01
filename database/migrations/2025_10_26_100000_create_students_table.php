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
            $table->string('second_name');
            $table->date('dob')->nullable();
            $table->string('gender', 10)->nullable();
            $table->string('father_name')->nullable();
            $table->string('email')->nullable();
            $table->string('emergency_phone')->nullable();
            $table->string('mother_name')->nullable();
            $table->unsignedBigInteger('parent_user_id')->nullable()->index();
            $table->string('phone')->nullable();
            $table->string('photo_path')->nullable();
            $table->string('status')->default('active')->index();
            $table->unsignedBigInteger('registered_by')->nullable()->index();
            $table->string('jersey_number')->nullable();
            $table->string('jersey_name')->nullable();
            $table->string('sport_discipline')->nullable();
            $table->string('school_name')->nullable();
            $table->string('position')->nullable();
            $table->string('coach')->nullable();
            $table->timestamp('joined_at')->nullable()->index();
            $table->string('program')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable()->index();
            $table->unsignedBigInteger('group_id')->nullable()->index();
            $table->string('combination')->nullable();
            $table->string('membership_type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
