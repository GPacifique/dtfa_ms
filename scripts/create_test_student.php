<?php
// Creates a test student and writes a small demo PNG into storage/app/public/photos/students
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Student;
use Illuminate\Support\Facades\Storage;

// Create a unique filename
$filename = 'demo_' . time() . '_' . bin2hex(random_bytes(4)) . '.png';
$dst = 'photos/students/' . $filename;

// Small 64x64 PNG (solid color) base64
$pngBase64 = 'iVBORw0KGgoAAAANSUhEUgAAAEAAAAAQCAYAAAB0E1fIAAAACXBIWXMAAAsTAAALEwEAmpwYAAABKUlEQVR4nO2WvQ3CMAxFv0oRQ0Q2sQ1qg3aC9g2qg3aC9g3aC9g3aC9gXcQZt8y3oYg4Ykiq0n0zP0wzQ4z6b3gY7p7h3g4fYBNg9nZ2Vh0g9H3l3wLQ0s4y5K7w5gQe4J6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQeI6ykx3w0i4Y6wV8g2k5iQ4yq7w5gQf0H7q3T8sD7kVAAAAAElFTkSuQmCC';
$pngData = base64_decode($pngBase64);

// Ensure storage directory exists
Storage::disk('public')->makeDirectory('photos/students');

if (!Storage::disk('public')->put($dst, $pngData)) {
    echo "Failed to write demo image to public disk at {$dst}\n";
    exit(1);
}

$student = new Student();
$student->first_name = 'Test';
$student->second_name = 'Student';
$student->email = 'test.student+' . time() . '@example.test';
$student->status = 'active';
$student->registered_by = null;
$student->photo_path = $dst;
$student->save();

echo "Created student id={$student->id}, photo_path={$student->photo_path}\n";

$url = config('app.url') ?? env('APP_URL') ?? 'http://localhost';
$publicUrl = rtrim($url, '/') . '/storage/' . ltrim($student->photo_path, '/');
echo "Accessible URL: {$publicUrl}\n";

exit(0);
