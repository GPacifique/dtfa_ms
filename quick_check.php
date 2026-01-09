<?php
$pdo = new PDO('sqlite:database/database.sqlite');
$stmt = $pdo->query('SELECT COUNT(*) FROM students');
echo "Student count: " . $stmt->fetchColumn() . "\n";

$stmt2 = $pdo->query('SELECT id, first_name, photo_path FROM students LIMIT 5');
while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
    echo "ID: {$row['id']} | Name: {$row['first_name']} | Photo: " . ($row['photo_path'] ?? 'NULL') . "\n";
}
