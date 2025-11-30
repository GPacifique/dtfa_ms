<?php

/**
 * Image Display Diagnostic Script
 * Run this via: php artisan tinker
 * Then paste the contents or use: exec(file_get_contents('image-diagnostics.php'))
 */

// Bootstrap Laravel
require_once __DIR__ . '/bootstrap/app.php';

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Student;
use App\Models\User;

echo "\n" . str_repeat("=", 70) . "\n";
echo "IMAGE DISPLAY DIAGNOSTIC REPORT\n";
echo str_repeat("=", 70) . "\n\n";

// 1. Check .env configuration
echo "1. ENVIRONMENT CONFIGURATION\n";
echo str_repeat("-", 70) . "\n";
$appUrl = env('APP_URL');
echo "   APP_URL: " . ($appUrl ?: "NOT SET") . "\n";
echo "   APP_DEBUG: " . (env('APP_DEBUG') ? "true" : "false") . "\n";
echo "   FILESYSTEM_DISK: " . env('FILESYSTEM_DISK', 'local') . "\n";
echo "   ✓ Check: APP_URL should be your actual domain (no trailing slash)\n\n";

// 2. Check symlink
echo "2. STORAGE SYMLINK\n";
echo str_repeat("-", 70) . "\n";
$symlinkPath = public_path('storage');
$targetPath = storage_path('app/public');

if (is_link($symlinkPath)) {
    echo "   ✓ Symlink EXISTS at: public/storage\n";
    $target = readlink($symlinkPath);
    echo "   → Points to: $target\n";
    echo "   → Resolves to: " . realpath($symlinkPath) . "\n";
} else {
    echo "   ✗ Symlink MISSING!\n";
    echo "   → Fix: Run 'php artisan storage:link'\n";
}
echo "\n";

// 3. Check directories exist
echo "3. DIRECTORY STRUCTURE\n";
echo str_repeat("-", 70) . "\n";

$directories = [
    'Storage Public' => storage_path('app/public'),
    'Student Photos' => storage_path('app/public/photos/students'),
    'User Profiles' => storage_path('app/public/profile-pictures'),
];

foreach ($directories as $label => $path) {
    $exists = File::isDirectory($path);
    $symbol = $exists ? '✓' : '✗';
    echo "   $symbol $label: " . ($exists ? "EXISTS" : "MISSING") . "\n";
    if (!$exists) {
        echo "      → Creating directory...\n";
        File::makeDirectory($path, 0755, true, true);
        echo "      → Created.\n";
    }
}
echo "\n";

// 4. Check permissions
echo "4. FILE PERMISSIONS\n";
echo str_repeat("-", 70) . "\n";

function getPermissions($path) {
    $perms = fileperms($path);
    return substr(sprintf('%o', $perms), -3);
}

foreach ($directories as $label => $path) {
    if (is_dir($path)) {
        $perms = getPermissions($path);
        $ok = $perms == '755' || $perms == '777';
        $symbol = $ok ? '✓' : '⚠';
        echo "   $symbol $label: $perms " . ($ok ? "(OK)" : "(should be 755)") . "\n";
    }
}
echo "\n";

// 5. Check storage disk configuration
echo "5. STORAGE DISK CONFIGURATION\n";
echo str_repeat("-", 70) . "\n";

$config = config('filesystems.disks.public');
echo "   Driver: " . $config['driver'] . "\n";
echo "   Root: " . $config['root'] . "\n";
echo "   URL Prefix: " . $config['url'] . "\n";
echo "   Visibility: " . $config['visibility'] . "\n";
echo "\n";

// 6. Count and list image files
echo "6. EXISTING IMAGE FILES\n";
echo str_repeat("-", 70) . "\n";

$studentPhotos = File::exists(storage_path('app/public/photos/students'))
    ? File::files(storage_path('app/public/photos/students'))
    : [];

$userPhotos = File::exists(storage_path('app/public/profile-pictures'))
    ? File::files(storage_path('app/public/profile-pictures'))
    : [];

echo "   Student Photos: " . count($studentPhotos) . " file(s)\n";
if (count($studentPhotos) > 0 && count($studentPhotos) <= 10) {
    foreach ($studentPhotos as $file) {
        echo "      - " . basename($file) . "\n";
    }
} elseif (count($studentPhotos) > 10) {
    echo "      (First 5 of " . count($studentPhotos) . ")\n";
    foreach (array_slice($studentPhotos, 0, 5) as $file) {
        echo "      - " . basename($file) . "\n";
    }
}

echo "   User Profile Pictures: " . count($userPhotos) . " file(s)\n";
if (count($userPhotos) > 0 && count($userPhotos) <= 10) {
    foreach ($userPhotos as $file) {
        echo "      - " . basename($file) . "\n";
    }
}
echo "\n";

// 7. Check database records with photos
echo "7. DATABASE RECORDS WITH PHOTOS\n";
echo str_repeat("-", 70) . "\n";

$studentsWithPhotos = Student::whereNotNull('photo_path')->count();
$studentsWithImages = Student::whereNotNull('image_path')->count();
$usersWithPhotos = User::whereNotNull('profile_picture_path')->count();

echo "   Students with photo_path: $studentsWithPhotos\n";
echo "   Students with image_path (legacy): $studentsWithImages\n";
echo "   Users with profile_picture_path: $usersWithPhotos\n";
echo "\n";

// 8. Test URL generation
echo "8. URL GENERATION TESTS\n";
echo str_repeat("-", 70) . "\n";

if ($studentsWithPhotos > 0) {
    $student = Student::whereNotNull('photo_path')->first();
    echo "   Sample Student: " . $student->first_name . " " . $student->second_name . "\n";
    echo "   Stored Path: " . $student->photo_path . "\n";
    echo "   Generated URL:\n";
    echo "      " . $student->photo_url . "\n";
    echo "\n";
}

if ($usersWithPhotos > 0) {
    $user = User::whereNotNull('profile_picture_path')->first();
    echo "   Sample User: " . $user->name . "\n";
    echo "   Stored Path: " . $user->profile_picture_path . "\n";
    echo "   Generated URL:\n";
    echo "      " . $user->profile_picture_url . "\n";
    echo "\n";
}

// 9. Test storage operations
echo "9. STORAGE OPERATIONS\n";
echo str_repeat("-", 70) . "\n";

try {
    $testPath = 'test-write-permission.txt';
    Storage::disk('public')->put($testPath, 'test content');
    echo "   ✓ Write Permission: OK (can create files)\n";
    Storage::disk('public')->delete($testPath);
    echo "   ✓ Delete Permission: OK (can delete files)\n";
} catch (Exception $e) {
    echo "   ✗ Storage Error: " . $e->getMessage() . "\n";
}
echo "\n";

// 10. Recommendations
echo "10. RECOMMENDATIONS\n";
echo str_repeat("-", 70) . "\n";

$issues = [];

if (!is_link($symlinkPath)) {
    $issues[] = "Run 'php artisan storage:link' to create symlink";
}

if ($appUrl === null || $appUrl === 'http://localhost') {
    $issues[] = "Update APP_URL in .env to match your actual domain";
}

if (empty($issues)) {
    echo "   ✓ All checks passed! Images should display correctly.\n";
} else {
    echo "   Issues found:\n";
    foreach ($issues as $i => $issue) {
        echo "   " . ($i + 1) . ". $issue\n";
    }
}

echo "\n" . str_repeat("=", 70) . "\n";
echo "END OF DIAGNOSTIC REPORT\n";
echo str_repeat("=", 70) . "\n\n";
