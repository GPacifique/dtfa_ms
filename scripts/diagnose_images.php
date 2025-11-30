#!/usr/bin/env php
<?php

/**
 * Image Display Diagnostic Script
 * Run this to diagnose image display issues
 *
 * Usage: php scripts/diagnose_images.php
 */

require __DIR__ . '/../bootstrap/app.php';

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

$app = require __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// Colors for output
$colors = [
    'green' => "\033[32m",
    'red' => "\033[31m",
    'yellow' => "\033[33m",
    'blue' => "\033[34m",
    'reset' => "\033[0m"
];

function print_section($title) {
    global $colors;
    echo "\n{$colors['blue']}=== {$title} ==={$colors['reset']}\n";
}

function print_ok($message) {
    global $colors;
    echo "{$colors['green']}✓ {$message}{$colors['reset']}\n";
}

function print_error($message) {
    global $colors;
    echo "{$colors['red']}✗ {$message}{$colors['reset']}\n";
}

function print_warning($message) {
    global $colors;
    echo "{$colors['yellow']}⚠ {$message}{$colors['reset']}\n";
}

// 1. Check storage symlink
print_section("1. STORAGE SYMLINK");
$symlink_path = public_path('storage');
if (is_link($symlink_path) || is_dir($symlink_path)) {
    $real_path = realpath($symlink_path);
    print_ok("Storage directory exists at: {$symlink_path}");
    print_ok("Points to: {$real_path}");
} else {
    print_error("Storage symlink NOT FOUND at: {$symlink_path}");
    print_warning("Run: php artisan storage:link");
}

// 2. Check storage directory contents
print_section("2. IMAGE FILES");
$storage_path = storage_path('app/public/photos/students');
if (is_dir($storage_path)) {
    $files = array_filter(scandir($storage_path), fn($f) => !in_array($f, ['.', '..', '.gitignore']));
    $count = count($files);
    print_ok("Found {$count} image files in: {$storage_path}");
    if ($count > 0) {
        echo "Sample files:\n";
        foreach (array_slice($files, 0, 5) as $file) {
            echo "  - {$file}\n";
        }
    }
} else {
    print_error("Directory not found: {$storage_path}");
}

// 3. Check database records
print_section("3. DATABASE RECORDS");
$total_students = DB::table('students')->count();
$with_photos = DB::table('students')->whereNotNull('photo_path')->count();
$without_photos = $total_students - $with_photos;

print_ok("Total students: {$total_students}");
print_ok("Students with photo_path: {$with_photos}");
if ($without_photos > 0) {
    print_warning("Students WITHOUT photo_path: {$without_photos}");
}

// 4. Check for problematic paths
print_section("4. PATH VALIDATION");
$bad_paths = DB::table('students')
    ->whereNotNull('photo_path')
    ->where(function($q) {
        $q->where('photo_path', 'LIKE', 'public/%')
          ->orWhere('photo_path', 'LIKE', 'storage/%')
          ->orWhere('photo_path', 'LIKE', '%public/public%');
    })
    ->count();

if ($bad_paths === 0) {
    print_ok("No problematic path formats found");
} else {
    print_error("Found {$bad_paths} records with incorrect path format");
    print_warning("Expected format: photos/students/filename.ext");
}

// 5. Test URL generation for sample student
print_section("5. URL GENERATION TEST");
$sample_student = DB::table('students')->whereNotNull('photo_path')->first();
if ($sample_student) {
    echo "Sample student ID: {$sample_student->id}\n";
    echo "Stored photo_path: {$sample_student->photo_path}\n";

    // Simulate URL generation
    $path = $sample_student->photo_path;
    $generated_url = config('app.url') . '/storage/' . ltrim($path, '/');
    echo "Generated URL: {$generated_url}\n";

    // Check if file exists
    $disk_exists = Storage::disk('public')->exists(ltrim($path, '/'));
    if ($disk_exists) {
        print_ok("File exists on disk");
    } else {
        print_error("File NOT found on disk");
    }
} else {
    print_warning("No students with photos to test");
}

// 6. Configuration check
print_section("6. CONFIGURATION");
$public_disk = config('filesystems.disks.public');
echo "Public disk root: {$public_disk['root']}\n";
echo "Public disk URL: {$public_disk['url']}\n";
echo "APP_URL: " . config('app.url') . "\n";

// 7. Directory permissions
print_section("7. DIRECTORY PERMISSIONS");
$storage_dir = storage_path('app/public');
if (is_writable($storage_dir)) {
    print_ok("Storage directory is writable");
} else {
    print_warning("Storage directory is NOT writable");
}

// 8. Summary
print_section("SUMMARY");
if ($with_photos > 0 && $bad_paths === 0 && is_dir($storage_path)) {
    print_ok("All systems are configured correctly!");
    print_ok("If images still don't show, check:");
    echo "  1. Browser DevTools Network tab (check image URL)\n";
    echo "  2. Run: php artisan cache:clear\n";
    echo "  3. Verify the exact filename matches the stored path\n";
} else {
    print_error("Issues found - see above for details");
}

echo "\n";
