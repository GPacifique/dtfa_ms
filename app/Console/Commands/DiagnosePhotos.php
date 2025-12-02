<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DiagnosePhotos extends Command
{
    protected $signature = 'diagnose:photos';
    protected $description = 'Diagnose photo upload and display issues';

    public function handle()
    {
        $this->info('🔍 Photo System Diagnostic');
        $this->newLine();

        // Check storage link
        $storageLinkExists = is_link(public_path('storage')) || is_dir(public_path('storage'));
        $this->line('Storage Link: ' . ($storageLinkExists ? '✅ EXISTS' : '❌ MISSING'));

        if (!$storageLinkExists) {
            $this->error('Run: php artisan storage:link');
            return 1;
        }

        // Check directories
        $this->line('Storage Directories:');
        $studentsDir = storage_path('app/public/photos/students');
        $this->line('  Students: ' . (is_dir($studentsDir) ? '✅' : '❌') . ' ' . $studentsDir);

        // Count photos
        $photoCount = Student::whereNotNull('photo_path')->count();
        $totalStudents = Student::count();
        $this->line("Students with photos: {$photoCount} / {$totalStudents}");
        $this->newLine();

        // Check recent students
        $this->info('Recent 5 Students:');
        $this->newLine();

        Student::orderBy('id', 'desc')->take(5)->get()->each(function($student) {
            $this->line("ID: {$student->id} | {$student->first_name} {$student->second_name}");
            $this->line("  photo_path DB: " . ($student->photo_path ?? '❌ NULL'));

            if ($student->photo_path) {
                $fullPath = storage_path("app/public/{$student->photo_path}");
                $exists = file_exists($fullPath);
                $this->line("  File exists: " . ($exists ? '✅ YES' : '❌ NO'));
                $this->line("  photo_url: {$student->photo_url}");

                if ($exists) {
                    $size = filesize($fullPath);
                    $this->line("  File size: " . number_format($size) . " bytes");
                }
            } else {
                $this->line("  Using fallback avatar");
            }
            $this->newLine();
        });

        // Check if any photos in directory aren't in database
        $filesInStorage = collect(Storage::disk('public')->files('photos/students'))->count();
        $this->info("Files in storage/app/public/photos/students: {$filesInStorage}");
        $this->info("Records in database with photo_path: {$photoCount}");

        if ($filesInStorage > $photoCount) {
            $this->warn("⚠️ There are orphaned files in storage not linked to any student");
        }

        $this->newLine();
        $this->info('✅ Diagnostic complete!');

        return 0;
    }
}
