<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
public function up(): void
{
Schema::create('student_attendance', function (Blueprint $table) {
$table->id();
$table->unsignedBigInteger('student_id')->index();
$table->date('attendance_date')->index();
$table->enum('status', ['present', 'absent', 'late', 'excused'])->default('present');
$table->text('remarks')->nullable();
$table->unsignedBigInteger('recorded_by')->nullable();
$table->timestamps();


$table->unique(['student_id', 'attendance_date']);
$table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
});
}


public function down(): void
{
Schema::dropIfExists('student_attendance');
}
};
