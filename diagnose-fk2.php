<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();
$kernel->handle($request);

use Illuminate\Support\Facades\DB;

echo "Attempting insert with FK checks disabled...\n";

try {
    DB::statement('SET FOREIGN_KEY_CHECKS=0');

    DB::insert('INSERT INTO student_attendance (student_id, attendance_date, status, remarks, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())', [
        1,
        date('Y-m-d'),
        'present',
        'Test with FK disabled'
    ]);

    DB::statement('SET FOREIGN_KEY_CHECKS=1');

    echo "[✓] Insert succeeded with FK checks disabled!\n";
    echo "This suggests there might be an issue with the FK constraint definition.\n";

} catch (\Exception $e) {
    echo "[✗] Still failed: {$e->getMessage()}\n";
}

// Try checking if there's an issue with the specific student
echo "\nDebugging student 1:\n";
$student = DB::selectOne('SELECT * FROM students WHERE id = 1');
var_dump($student);

// Check if there's a soft delete or something
echo "\nFirst 5 students:\n";
$students = DB::select('SELECT id, first_name, second_name, status, deleted_at FROM students LIMIT 5');
foreach ($students as $s) {
    echo "- ID {$s->id}: {$s->first_name} {$s->second_name} (status: {$s->status})\n";
}
