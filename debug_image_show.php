<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== DEBUGGING STUDENT IMAGE ===\n";

// 1. Find a student with a photo
$student = App\Models\Student::whereNotNull('photo_path')->where('photo_path', '!=', '')->first();

if (!$student) {
    echo "No student with photo found.\n";
    exit;
}

echo "Student ID: {$student->id}\n";
echo "Name: {$student->first_name}\n";
echo "DB Photo Path: '{$student->photo_path}'\n";

// 2. Check Model Accessor
echo "\n--- Model Accessor ---\n";
try {
    $url = $student->photo_url;
    echo "Accessor (photo_url): {$url}\n";
} catch (\Exception $e) {
    echo "Accessor Error: " . $e->getMessage() . "\n";
}

// 3. Check Storage Existence (Public Disk)
echo "\n--- Storage Check (Public Disk) ---\n";
$disk = Illuminate\Support\Facades\Storage::disk('public');
$exists = $disk->exists($student->photo_path);
echo "Disk Root: " . $disk->path('') . "\n";
echo "Full Path: " . $disk->path($student->photo_path) . "\n";
echo "Exists on 'public' disk? " . ($exists ? "YES" : "NO") . "\n";

// 4. Check File System Directly
echo "\n--- File System Check ---\n";
$realPath = $disk->path($student->photo_path);
echo "is_file('{$realPath}')? " . (is_file($realPath) ? "YES" : "NO") . "\n";

// 5. Simulate PhotoController Logic
echo "\n--- Controller Logic Simulation ---\n";
$path = $student->photo_path;
if (!$path || !$disk->exists($path)) {
    echo "Controller would abort 404 (File not found on disk)\n";
} else {
    echo "Controller would attempt to serve file.\n";
    try {
        $mime = $disk->mimeType($path);
        echo "Mime Type: {$mime}\n";
    } catch (\Exception $e) {
        echo "Mime Type Error: " . $e->getMessage() . "\n";
    }
}

echo "\n=== END DEBUG ===\n";
