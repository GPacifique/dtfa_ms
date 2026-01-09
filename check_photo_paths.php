<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

echo "=== PHOTO PATH DIAGNOSTIC ===\n\n";

// Check database connection
echo "Database Connection: " . config('database.default') . "\n";
echo "Filesystem Disk: " . config('filesystems.default') . "\n";
echo "Public Disk Root: " . Storage::disk('public')->path('') . "\n\n";

// Check student count
$count = DB::table('students')->count();
echo "Total Students in DB: {$count}\n\n";

// Get students with photo_path
$students = DB::table('students')
    ->select('id', 'first_name', 'second_name', 'photo_path')
    ->limit(20)
    ->get();

echo "=== STUDENT PHOTO PATHS (first 20) ===\n";
foreach ($students as $s) {
    $photoPath = $s->photo_path ?? 'NULL';
    $exists = false;
    $fullPath = '';

    if ($s->photo_path) {
        $exists = Storage::disk('public')->exists($s->photo_path);
        $fullPath = Storage::disk('public')->path($s->photo_path);
    }

    echo "ID: {$s->id} | Name: {$s->first_name} {$s->second_name}\n";
    echo "  Photo Path (DB): {$photoPath}\n";
    if ($s->photo_path) {
        echo "  Full Path: {$fullPath}\n";
        echo "  Exists: " . ($exists ? 'YES' : 'NO') . "\n";
    }
    echo "\n";
}

// Check storage directory
echo "\n=== STORAGE CHECK ===\n";
$storagePath = storage_path('app/public');
echo "Storage Path: {$storagePath}\n";
echo "Exists: " . (is_dir($storagePath) ? 'YES' : 'NO') . "\n";

// Check for photos/students directory
$studentsDir = $storagePath . '/photos/students';
echo "\nPhotos/Students Directory: {$studentsDir}\n";
echo "Exists: " . (is_dir($studentsDir) ? 'YES' : 'NO') . "\n";

if (is_dir($studentsDir)) {
    $files = scandir($studentsDir);
    $files = array_diff($files, ['.', '..']);
    echo "Files in photos/students directory: " . count($files) . "\n";
    if (count($files) <= 10) {
        foreach ($files as $file) {
            echo "  - {$file}\n";
        }
    } else {
        echo "  (showing first 10)\n";
        $i = 0;
        foreach ($files as $file) {
            if ($i++ >= 10) break;
            echo "  - {$file}\n";
        }
    }
}

// Check public symlink
echo "\n=== PUBLIC SYMLINK CHECK ===\n";
$publicStorage = public_path('storage');
echo "Public/storage path: {$publicStorage}\n";
echo "Is symlink: " . (is_link($publicStorage) ? 'YES' : 'NO') . "\n";
echo "Is directory: " . (is_dir($publicStorage) ? 'YES' : 'NO') . "\n";

if (is_link($publicStorage)) {
    echo "Symlink target: " . readlink($publicStorage) . "\n";
}

// Test route generation
echo "\n=== ROUTE TEST ===\n";
try {
    $testStudent = Student::first();
    if ($testStudent) {
        echo "Route URL for student ID {$testStudent->id}: " . route('student.photo', $testStudent->id) . "\n";
        echo "Photo URL attribute: " . $testStudent->photo_url . "\n";
    } else {
        echo "No students found in DB\n";
    }
} catch (Exception $e) {
    echo "Route Error: " . $e->getMessage() . "\n";
}
