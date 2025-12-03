<?php

namespace App\Console\Commands;

use App\Models\Student;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class CheckPhotoAccess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photo:check {filename? : The photo filename to check}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check photo file access and diagnose issues';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');

        if ($filename) {
            $this->checkSpecificPhoto($filename);
        } else {
            $this->checkAllPhotos();
        }
    }

    /**
     * Check a specific photo by filename
     */
    protected function checkSpecificPhoto(string $filename)
    {
        $this->info("🔍 Checking photo: {$filename}");
        $this->newLine();

        // Search for students with this filename in photo_path
        $students = Student::where('photo_path', 'like', "%{$filename}%")
            ->get(['id', 'first_name', 'second_name', 'photo_path']);

        if ($students->isEmpty()) {
            $this->warn("❌ No students found with photo filename: {$filename}");
            $this->newLine();

            // Check if file exists in storage anyway
            $possiblePaths = [
                "photos/students/{$filename}",
                "students/{$filename}",
                $filename,
            ];

            foreach ($possiblePaths as $path) {
                if (Storage::disk('public')->exists($path)) {
                    $this->info("✅ File found in storage at: {$path}");
                    $this->info("📏 Size: " . Storage::disk('public')->size($path) . " bytes");
                    $this->info("📅 Last modified: " . date('Y-m-d H:i:s', Storage::disk('public')->lastModified($path)));
                    $this->newLine();

                    // Show how to access it
                    $this->info("🌐 Access URLs:");
                    $this->line("   Storage URL: " . Storage::disk('public')->url($path));
                    $this->line("   Asset URL: " . asset('storage/' . $path));
                    return;
                }
            }

            $this->error("❌ File not found in storage");
            return;
        }

        // Display student info
        $this->info("👤 Found {$students->count()} student(s) with this photo:");
        $this->newLine();

        foreach ($students as $student) {
            $this->line("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
            $this->info("ID: {$student->id}");
            $this->info("Name: {$student->first_name} {$student->second_name}");
            $this->info("Photo Path (DB): {$student->photo_path}");
            $this->newLine();

            // Check if file exists
            $exists = Storage::disk('public')->exists($student->photo_path);

            if ($exists) {
                $this->info("✅ File exists in storage");
                $this->info("📏 Size: " . Storage::disk('public')->size($student->photo_path) . " bytes");
                $this->info("📅 Last modified: " . date('Y-m-d H:i:s', Storage::disk('public')->lastModified($student->photo_path)));
                $this->info("📂 Full path: " . Storage::disk('public')->path($student->photo_path));
                $this->newLine();

                // Show access URLs
                $this->info("🌐 Access URLs:");
                $this->line("   PhotoController: " . route('photos.student', ['student' => $student->id]));
                $this->line("   Storage URL: " . Storage::disk('public')->url($student->photo_path));
                $this->line("   Asset URL: " . asset('storage/' . $student->photo_path));
                $this->line("   Accessor: " . $student->photo_url);
            } else {
                $this->error("❌ File NOT found in storage");
                $this->warn("Expected location: " . Storage::disk('public')->path($student->photo_path));
                $this->newLine();
                $this->info("🔧 The student will see a fallback avatar instead");
                $this->line("   Fallback URL: " . $student->photo_url);
            }
            $this->newLine();
        }
    }

    /**
     * Check all photos in the system
     */
    protected function checkAllPhotos()
    {
        $this->info("📊 Checking all photos in the system...");
        $this->newLine();

        // Get statistics
        $totalStudents = Student::count();
        $studentsWithPhotos = Student::whereNotNull('photo_path')->where('photo_path', '!=', '')->count();
        $studentsWithoutPhotos = $totalStudents - $studentsWithPhotos;

        $this->table(
            ['Metric', 'Count'],
            [
                ['Total Students', $totalStudents],
                ['Students with photo_path', $studentsWithPhotos],
                ['Students without photos', $studentsWithoutPhotos],
            ]
        );

        $this->newLine();

        // Check storage directory
        $this->info("📁 Checking storage directory...");

        $disk = Storage::disk('public');
        $photoPath = 'photos/students';

        if ($disk->exists($photoPath)) {
            $files = $disk->files($photoPath);
            $this->info("✅ Storage directory exists: storage/app/public/{$photoPath}");
            $this->info("📸 Files in storage: " . count($files));
            $this->newLine();

            // Check for orphaned files
            $this->info("🔍 Checking for orphaned files...");

            $studentsWithPhotoPaths = Student::whereNotNull('photo_path')
                ->where('photo_path', '!=', '')
                ->pluck('photo_path')
                ->toArray();

            $orphanedFiles = [];
            $missingFiles = [];

            foreach ($files as $file) {
                if (!in_array($file, $studentsWithPhotoPaths)) {
                    $orphanedFiles[] = basename($file);
                }
            }

            foreach ($studentsWithPhotoPaths as $path) {
                if (!$disk->exists($path)) {
                    $missingFiles[] = $path;
                }
            }

            if (count($orphanedFiles) > 0) {
                $this->warn("⚠️  Found " . count($orphanedFiles) . " orphaned file(s) (in storage but not in database)");
                if (count($orphanedFiles) <= 10) {
                    foreach ($orphanedFiles as $file) {
                        $this->line("   - {$file}");
                    }
                }
            } else {
                $this->info("✅ No orphaned files");
            }

            if (count($missingFiles) > 0) {
                $this->error("❌ Found " . count($missingFiles) . " missing file(s) (in database but not in storage)");
                if (count($missingFiles) <= 10) {
                    foreach ($missingFiles as $file) {
                        $this->line("   - {$file}");
                    }
                }
            } else {
                $this->info("✅ No missing files");
            }

        } else {
            $this->error("❌ Storage directory does NOT exist: storage/app/public/{$photoPath}");
            $this->warn("Run: mkdir -p storage/app/public/photos/students");
        }

        $this->newLine();

        // Check symlink
        $this->info("🔗 Checking storage symlink...");
        $symlinkPath = public_path('storage');

        if (is_link($symlinkPath)) {
            $target = readlink($symlinkPath);
            $this->info("✅ Symlink exists: public/storage -> {$target}");
        } elseif (file_exists($symlinkPath)) {
            $this->warn("⚠️  public/storage exists but is not a symlink");
        } else {
            $this->error("❌ Symlink does NOT exist");
            $this->warn("Run: php artisan storage:link");
        }

        $this->newLine();

        // Show recent students with photos
        $this->info("📸 Recent students with photos:");

        $recentWithPhotos = Student::whereNotNull('photo_path')
            ->where('photo_path', '!=', '')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get(['id', 'first_name', 'second_name', 'photo_path']);

        if ($recentWithPhotos->isNotEmpty()) {
            foreach ($recentWithPhotos as $student) {
                $exists = Storage::disk('public')->exists($student->photo_path);
                $status = $exists ? '✅' : '❌';
                $this->line("{$status} [{$student->id}] {$student->first_name} {$student->second_name}");
            }
        } else {
            $this->warn("No students with photos found");
        }

        $this->newLine();
        $this->info("💡 Tip: Run 'php artisan photo:check {filename}' to check a specific photo");
    }
}
