<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== IMAGE DIAGNOSTICS ===\n\n";

// Check APP_URL
echo "APP_URL: " . config('app.url') . "\n";
echo "Filesystem URL: " . config('filesystems.disks.public.url') . "\n\n";

// Check symlink
$symlinkPath = public_path('storage');
$symlinkExists = file_exists($symlinkPath);
$symlinkIsLink = is_link($symlinkPath);
echo "Symlink exists: " . ($symlinkExists ? 'YES' : 'NO') . "\n";
echo "Is symlink: " . ($symlinkIsLink ? 'YES' : 'NO') . "\n";
if ($symlinkIsLink) {
    echo "Points to: " . readlink($symlinkPath) . "\n";
}
echo "\n";

// Check students with photos
$studentsWithPhotos = App\Models\Student::whereNotNull('photo_path')->get();
echo "Students with photo_path: " . $studentsWithPhotos->count() . "\n\n";

if ($studentsWithPhotos->count() > 0) {
    echo "Sample student data:\n";
    $sample = $studentsWithPhotos->first();
    echo "ID: " . $sample->id . "\n";
    echo "Name: " . $sample->first_name . " " . ($sample->second_name ?? $sample->last_name) . "\n";
    echo "Photo path: " . $sample->photo_path . "\n";
    echo "Photo URL: " . $sample->photo_url . "\n";

    $pathWithoutLeadingSlash = ltrim($sample->photo_path, '/');
    $fileExists = Storage::disk('public')->exists($pathWithoutLeadingSlash);
    echo "File exists: " . ($fileExists ? 'YES' : 'NO') . "\n";

    if (!$fileExists) {
        // Try with different path formats
        echo "\nTrying different path formats:\n";
        $formats = [
            $sample->photo_path,
            ltrim($sample->photo_path, '/'),
            'photos/students/' . basename($sample->photo_path),
        ];
        foreach ($formats as $format) {
            $exists = Storage::disk('public')->exists($format);
            echo "  - '$format': " . ($exists ? 'EXISTS' : 'NOT FOUND') . "\n";
        }
    }
    echo "\n";
}

// Check files in storage
$storagePath = storage_path('app/public/photos/students');
if (is_dir($storagePath)) {
    $files = scandir($storagePath);
    $imageFiles = array_filter($files, function($file) use ($storagePath) {
        return is_file($storagePath . '/' . $file) && preg_match('/\.(jpg|jpeg|png|gif|webp)$/i', $file);
    });
    echo "Image files in storage: " . count($imageFiles) . "\n";
    echo "Sample files:\n";
    foreach (array_slice($imageFiles, 0, 5) as $file) {
        echo "  - $file\n";
    }
}

echo "\n=== END DIAGNOSTICS ===\n";
