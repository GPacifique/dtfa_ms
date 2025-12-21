<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== FIXING STUDENT IMAGE PATHS ===\n\n";

$disk = Storage::disk('public');
$directory = 'photos/students';
$files = $disk->files($directory);

echo "Found " . count($files) . " files in $directory\n";

$updates = 0;
$errors = 0;

// Group files by student ID to find the latest one if duplicates exist
$studentFiles = [];

foreach ($files as $file) {
    $filename = basename($file);

    // Pattern: ID.Profile Picture.TIMESTAMP.ext
    if (preg_match('/^(\d+)\.Profile Picture\.(\d+)\.(jpg|jpeg|png|webp)$/i', $filename, $matches)) {
        $id = $matches[1];
        $timestamp = $matches[2];

        if (!isset($studentFiles[$id]) || $timestamp > $studentFiles[$id]['timestamp']) {
            $studentFiles[$id] = [
                'path' => $file,
                'timestamp' => $timestamp
            ];
        }
    }
}

echo "Found matching files for " . count($studentFiles) . " students.\n\n";

foreach ($studentFiles as $id => $data) {
    $student = Student::find($id);

    if ($student) {
        $currentPath = $student->photo_path;
        $newPath = $data['path'];

        // Only update if path is different or missing
        if ($currentPath !== $newPath) {
            // Check if current path is actually valid (don't overwrite if they have a newer working photo)
            if ($currentPath && $disk->exists($currentPath)) {
                echo "Skipping Student $id: Has valid existing photo ($currentPath)\n";
                continue;
            }

            $student->photo_path = $newPath;
            $student->save();
            echo "Updated Student $id: $currentPath -> $newPath\n";
            $updates++;
        }
    } else {
        echo "Warning: File found for Student ID $id, but student does not exist in DB.\n";
    }
}

echo "\n=== SUMMARY ===\n";
echo "Total Updates: $updates\n";
echo "Done.\n";
