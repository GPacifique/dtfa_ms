<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = \Illuminate\Http\Request::capture();
$kernel->handle($request);

use Illuminate\Support\Facades\DB;

echo "Checking database structure...\n\n";

// Check if student 1 exists
$student = DB::selectOne('SELECT * FROM students WHERE id = 1');
if ($student) {
    echo "[✓] Student ID 1 exists: {$student->first_name}\n";
} else {
    echo "[✗] Student ID 1 NOT FOUND\n";
}

// Check column types
echo "\nColumn Types:\n";
$cols = DB::select('SHOW COLUMNS FROM students WHERE Field = "id"');
foreach ($cols as $col) {
    echo "students.id: {$col->Type}\n";
}

$cols = DB::select('SHOW COLUMNS FROM student_attendance WHERE Field = "student_id"');
foreach ($cols as $col) {
    echo "student_attendance.student_id: {$col->Type}\n";
}

// Check foreign keys
echo "\nForeign Keys:\n";
$fks = DB::select("SELECT CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_COLUMN_NAME 
FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE 
WHERE TABLE_NAME = 'student_attendance' AND REFERENCED_TABLE_NAME IS NOT NULL");

foreach ($fks as $fk) {
    echo "- {$fk->CONSTRAINT_NAME}: {$fk->COLUMN_NAME} -> {$fk->REFERENCED_TABLE_NAME}({$fk->REFERENCED_COLUMN_NAME})\n";
}

// Try raw insert without foreign key check
echo "\nTrying raw insert...\n";
try {
    DB::insert('INSERT INTO student_attendance (student_id, attendance_date, status, remarks, created_at, updated_at) VALUES (?, ?, ?, ?, NOW(), NOW())', [
        1, 
        date('Y-m-d'), 
        'present', 
        'Diagnostic test'
    ]);
    echo "[✓] Insert succeeded!\n";
} catch (\Exception $e) {
    echo "[✗] Insert failed: {$e->getMessage()}\n";
}
