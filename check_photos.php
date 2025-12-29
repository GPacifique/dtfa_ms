<?php
require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Student Photo Paths ===\n";
foreach(\App\Models\Student::take(5)->get() as $s) {
    echo "ID: " . $s->id . "\n";
    echo "Name: " . $s->first_name . "\n";
    echo "Photo Path: " . ($s->photo_path ?? 'NULL') . "\n";
    echo "Photo URL: " . $s->photo_url . "\n";
    echo "---\n";
}

echo "\n=== Check if file exists ===\n";
$student = \App\Models\Student::whereNotNull('photo_path')->first();
if ($student) {
    echo "Student: " . $student->first_name . "\n";
    echo "Path: " . $student->photo_path . "\n";
    echo "Exists: " . (\Illuminate\Support\Facades\Storage::disk('public')->exists($student->photo_path) ? 'YES' : 'NO') . "\n";
    echo "URL: " . $student->photo_url . "\n";
}
