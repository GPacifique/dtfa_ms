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

echo "=== STUDENT 1 PHOTO DEBUG ===\n\n";
echo "Student ID: " . $student->id . "\n";
echo "Name: " . $student->first_name . " " . $student->second_name . "\n";
echo "photo_path (raw): '" . ($student->photo_path ?? 'NULL') . "'\n";
echo "photo_url: " . $student->photo_url . "\n\n";

if ($student->photo_path) {
    echo "=== FILE CHECK ===\n";
    $exists = Storage::disk('public')->exists($student->photo_path);
    echo "Storage::exists: " . ($exists ? 'YES' : 'NO') . "\n";
    
    $fullPath = Storage::disk('public')->path($student->photo_path);
    echo "Full path: " . $fullPath . "\n";
    echo "is_file: " . (is_file($fullPath) ? 'YES' : 'NO') . "\n";
    
    if (is_file($fullPath)) {
        echo "File size: " . filesize($fullPath) . " bytes\n";
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        echo "Detected MIME: " . finfo_file($finfo, $fullPath) . "\n";
        finfo_close($finfo);
    }
    
    // Try to get storage mime
    try {
        $storageMime = Storage::disk('public')->mimeType($student->photo_path);
        echo "Storage MIME: " . ($storageMime ?: 'null') . "\n";
    } catch (Exception $e) {
        echo "Storage MIME Error: " . $e->getMessage() . "\n";
    }
}
