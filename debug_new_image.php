<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DEBUGGING NEW FORMAT STUDENT IMAGE ===\n";

// Find a student with the NEW path format
$student = App\Models\Student::where('photo_path', 'LIKE', 'photos/students/%')->first();

if (!$student) {
    echo "No student with new path format found.\n";
    exit;
}

echo "Student ID: {$student->id}\n";
echo "Name: {$student->first_name}\n";
echo "DB Photo Path: '{$student->photo_path}'\n";

// Check Storage Existence (Public Disk)
echo "\n--- Storage Check (Public Disk) ---\n";
$disk = Illuminate\Support\Facades\Storage::disk('public');
$exists = $disk->exists($student->photo_path);
echo "Full Path: " . $disk->path($student->photo_path) . "\n";
echo "Exists on 'public' disk? " . ($exists ? "YES" : "NO") . "\n";

echo "\n=== END DEBUG ===\n";
