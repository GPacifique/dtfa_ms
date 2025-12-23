<?php

use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Fixing Student photo paths...\n";

$students = Student::whereNotNull('photo_path')->get();
$updated = 0;

foreach ($students as $student) {
    $originalPath = $student->photo_path;
    $newPath = null;

    // Case 1: Path is already correct
    if (Storage::disk('public')->exists($originalPath)) {
        echo "ID: {$student->id} - OK: {$originalPath}\n";
        continue;
    }

    // Case 2: Path is in photos/members_Images but DB says members_Images
    if (str_starts_with($originalPath, 'members_Images/')) {
        $candidate = 'photos/' . $originalPath;
        if (Storage::disk('public')->exists($candidate)) {
            $newPath = $candidate;
        }
    }

    // Case 3: Path is just a filename, check photos/students
    if (!$newPath && !str_contains($originalPath, '/')) {
        $candidate = 'photos/students/' . $originalPath;
        if (Storage::disk('public')->exists($candidate)) {
            $newPath = $candidate;
        }
    }

    // Case 4: Path is just a filename, check photos/members_Images
    if (!$newPath && !str_contains($originalPath, '/')) {
        $candidate = 'photos/members_Images/' . $originalPath;
        if (Storage::disk('public')->exists($candidate)) {
            $newPath = $candidate;
        }
    }

    if ($newPath) {
        echo "ID: {$student->id} - FIXING: {$originalPath} -> {$newPath}\n";
        $student->photo_path = $newPath;
        $student->save();
        $updated++;
    } else {
        echo "ID: {$student->id} - NOT FOUND: {$originalPath}\n";
    }
}

echo "Updated {$updated} records.\n";
