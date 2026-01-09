<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Student;
use Illuminate\Support\Facades\Storage;

$student = Student::find(1);
if (!$student) {
    echo "Student ID 1 not found\n";
    exit;
}

echo "Student ID: " . $student->id . "\n";
echo "Name: " . $student->first_name . " " . $student->second_name . "\n";
echo "photo_path: " . ($student->photo_path ?? 'NULL') . "\n";
echo "photo_url: " . $student->photo_url . "\n";

if ($student->photo_path) {
    $exists = Storage::disk('public')->exists($student->photo_path);
    echo "File exists: " . ($exists ? 'YES' : 'NO') . "\n";
    if ($exists) {
        $fullPath = Storage::disk('public')->path($student->photo_path);
        echo "Full path: " . $fullPath . "\n";
    }
}
