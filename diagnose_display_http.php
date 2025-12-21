<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
// Use HTTP Kernel instead of Console Kernel for route testing
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "=== DISPLAY DIAGNOSTICS (HTTP) ===\n\n";

// 1. Check Student 1 (Known fixed student)
$student = App\Models\Student::find(1);
if ($student) {
    echo "Student 1: {$student->first_name}\n";
    echo "Path: {$student->photo_path}\n";
    echo "URL: {$student->photo_url}\n";

    $disk = Illuminate\Support\Facades\Storage::disk('public');
    $exists = $disk->exists($student->photo_path);
    echo "File Exists on Disk: " . ($exists ? "YES" : "NO") . "\n";
}

echo "\n--- Route Test ---\n";
// Simulate a request to the photo route
$request = Illuminate\Http\Request::create('/photos/students/1', 'GET');
try {
    $response = $kernel->handle($request);
    echo "Status Code: " . $response->getStatusCode() . "\n";
    echo "Content-Type: " . $response->headers->get('Content-Type') . "\n";

    if ($response->getStatusCode() == 200) {
        echo "Route is working correctly.\n";
    } else {
        echo "Route returned error.\n";
    }
} catch (\Exception $e) {
    echo "Route Exception: " . $e->getMessage() . "\n";
}

echo "\n=== END DIAGNOSTICS ===\n";
