<?php
// Simple test to verify attendance recording works
// Run this from the command line: php test-attendance.php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();
$kernel->handle($request);

use App\Models\Student;
use App\Models\StudentAttendance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

echo "Testing Student Attendance Recording System\n";
echo "==========================================\n\n";

// Step 1: Check if students table has data
$studentCount = Student::count();
echo "[1] Total students in database: $studentCount\n";

if ($studentCount === 0) {
    echo "    ❌ ERROR: No students found! Create test students first.\n";
    exit(1);
}

// Step 2: Get a test student
$student = Student::where('status', 'active')->first();
if (!$student) {
    echo "    ❌ ERROR: No active students found!\n";
    exit(1);
}
echo "[2] Using test student: #{$student->id} - {$student->first_name} {$student->second_name}\n";

// Step 3: Try to record attendance
echo "[3] Attempting to record attendance...\n";
try {
    $attendance = StudentAttendance::updateOrCreate(
        [
            'student_id' => $student->id,
            'attendance_date' => now()->toDateString()
        ],
        [
            'status' => 'present',
            'recorded_by' => 1,
            'remarks' => 'Test recording'
        ]
    );
    echo "    ✅ Attendance recorded successfully!\n";
    echo "    Attendance ID: {$attendance->id}\n";
    echo "    Status: {$attendance->status}\n";
} catch (\Exception $e) {
    echo "    ❌ ERROR: {$e->getMessage()}\n";
    echo "    Exception: " . get_class($e) . "\n";
    exit(1);
}

// Step 4: Verify in database
$count = StudentAttendance::where('student_id', $student->id)
    ->where('attendance_date', now()->toDateString())
    ->count();

echo "[4] Verification:\n";
echo "    Records found for today: $count\n";

if ($count > 0) {
    echo "    ✅ SUCCESS: System is working correctly!\n";
} else {
    echo "    ❌ ERROR: Record not found in database!\n";
    exit(1);
}

echo "\nAll tests passed!\n";
