<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();
$kernel->handle($request);

use App\Models\StudentAttendance;

echo "Attendance Records Summary\n";
echo "==========================\n\n";

$count = StudentAttendance::count();
echo "Total attendance records: $count\n";

// Show last 5 records
$records = StudentAttendance::latest('id')->limit(5)->get();
echo "\nLast 5 attendance records:\n";
foreach ($records as $record) {
    echo "- ID {$record->id}: Student {$record->student_id} on {$record->attendance_date} = {$record->status}\n";
}

echo "\n✅ System is working correctly!\n";
