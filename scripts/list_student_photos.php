<?php

// Temporary script to list students with photo_path and file existence.
// Usage: php scripts/list_student_photos.php

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Student;
use Illuminate\Support\Facades\Storage;

$students = Student::query()->whereNotNull('photo_path')->get(['id','first_name','second_name','photo_path']);

if ($students->isEmpty()) {
    echo "No students with photo_path found in DB.\n";
    exit(0);
}

foreach ($students as $s) {
    $path = ltrim($s->photo_path, '/');
    $exists = Storage::disk('public')->exists($path) ? 'yes' : 'no';
    echo "ID: {$s->id} - {$s->first_name} {$s->second_name} - path: {$path} - file exists on disk: {$exists}\n";
}

echo "\nChecked storage disk 'public' (storage/app/public).\n";
