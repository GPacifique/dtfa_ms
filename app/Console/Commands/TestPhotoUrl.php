<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;

class TestPhotoUrl extends Command
{
    protected $signature = 'test:photo-url';
    protected $description = 'Test photo_url accessor for students';

    public function handle()
    {
        $this->info('Testing photo_url accessor...');
        $this->newLine();

        $student = Student::whereNotNull('photo_path')->first();

        if (!$student) {
            $this->error('No students with photos found in database.');
            return 1;
        }

        $this->info("Student ID: {$student->id}");
        $this->info("Name: {$student->first_name} {$student->second_name}");
        $this->newLine();

        $this->line("photo_path (from database): {$student->photo_path}");
        $this->line("photo_url (via accessor): {$student->photo_url}");
        $this->newLine();

        // Test if file exists
        $storagePath = storage_path("app/public/{$student->photo_path}");
        $fileExists = file_exists($storagePath);

        $this->line("Storage file exists: " . ($fileExists ? '✅ YES' : '❌ NO'));
        $this->line("Storage path: {$storagePath}");
        $this->newLine();

        // Test symlink
        $publicPath = public_path("storage/{$student->photo_path}");
        $symlinkWorks = file_exists($publicPath);

        $this->line("Public symlink works: " . ($symlinkWorks ? '✅ YES' : '❌ NO'));
        $this->line("Public path: {$publicPath}");
        $this->newLine();

        if ($fileExists && $symlinkWorks) {
            $this->info('✅ Photo URL system is working correctly!');
            $this->info("Browser URL: " . asset("storage/{$student->photo_path}"));
        } else {
            $this->warn('⚠️ Some issues detected. Check storage:link');
        }

        return 0;
    }
}
