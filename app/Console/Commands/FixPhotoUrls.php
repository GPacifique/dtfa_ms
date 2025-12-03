<?php

namespace App\Console\Commands;

use App\Models\Student;
use App\Models\Staff;
use App\Models\User;
use Illuminate\Console\Command;

class FixPhotoUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'photo:fix-urls {--dry-run : Show what would be fixed without making changes}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix photo_path fields that contain full URLs instead of relative paths';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dryRun = $this->option('dry-run');

        if ($dryRun) {
            $this->warn("🔍 DRY RUN MODE - No changes will be made");
            $this->newLine();
        } else {
            $this->info("🔧 Fixing photo URLs in database...");
            $this->newLine();
        }

        $studentsFixed = $this->fixStudentPhotos($dryRun);
        $staffFixed = $this->fixStaffPhotos($dryRun);
        $usersFixed = $this->fixUserPhotos($dryRun);

        $this->newLine();
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->info("📊 Summary:");
        $this->line("   Students fixed: {$studentsFixed}");
        $this->line("   Staff fixed: {$staffFixed}");
        $this->line("   Users fixed: {$usersFixed}");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");

        if ($dryRun && ($studentsFixed > 0 || $staffFixed > 0 || $usersFixed > 0)) {
            $this->newLine();
            $this->warn("💡 Run without --dry-run to apply these fixes:");
            $this->line("   php artisan photo:fix-urls");
        }

        if (!$dryRun && ($studentsFixed > 0 || $staffFixed > 0 || $usersFixed > 0)) {
            $this->newLine();
            $this->info("✅ Done! Photos should now work correctly.");
        }

        if ($studentsFixed === 0 && $staffFixed === 0 && $usersFixed === 0) {
            $this->newLine();
            $this->info("✅ No issues found - all photo paths are correct!");
        }

        return Command::SUCCESS;
    }

    /**
     * Fix student photo URLs
     */
    protected function fixStudentPhotos(bool $dryRun): int
    {
        $this->info("👨‍🎓 Checking students...");

        // Find students with URLs in photo_path
        $students = Student::where('photo_path', 'like', 'http%')->get();

        if ($students->isEmpty()) {
            $this->line("   ✅ All student photos are correct");
            return 0;
        }

        $fixed = 0;

        foreach ($students as $student) {
            $oldPath = $student->photo_path;
            $newPath = $this->extractRelativePath($oldPath);

            if ($newPath) {
                if ($dryRun) {
                    $this->line("   🔍 Would fix [{$student->id}] {$student->first_name} {$student->second_name}");
                    $this->line("      From: {$oldPath}");
                    $this->line("      To:   {$newPath}");
                } else {
                    $student->photo_path = $newPath;
                    $student->save();
                    $this->line("   ✅ Fixed [{$student->id}] {$student->first_name} {$student->second_name}");
                }
                $fixed++;
            }
        }

        return $fixed;
    }

    /**
     * Fix staff photo URLs
     */
    protected function fixStaffPhotos(bool $dryRun): int
    {
        $this->info("👔 Checking staff...");

        $staff = Staff::where('photo_path', 'like', 'http%')->get();

        if ($staff->isEmpty()) {
            $this->line("   ✅ All staff photos are correct");
            return 0;
        }

        $fixed = 0;

        foreach ($staff as $member) {
            $oldPath = $member->photo_path;
            $newPath = $this->extractRelativePath($oldPath);

            if ($newPath) {
                if ($dryRun) {
                    $this->line("   🔍 Would fix [{$member->id}] {$member->name}");
                    $this->line("      From: {$oldPath}");
                    $this->line("      To:   {$newPath}");
                } else {
                    $member->photo_path = $newPath;
                    $member->save();
                    $this->line("   ✅ Fixed [{$member->id}] {$member->name}");
                }
                $fixed++;
            }
        }

        return $fixed;
    }

    /**
     * Fix user photo URLs
     */
    protected function fixUserPhotos(bool $dryRun): int
    {
        $this->info("👤 Checking users...");

        $users = User::where('profile_picture_path', 'like', 'http%')->get();

        if ($users->isEmpty()) {
            $this->line("   ✅ All user photos are correct");
            return 0;
        }

        $fixed = 0;

        foreach ($users as $user) {
            $oldPath = $user->profile_picture_path;
            $newPath = $this->extractRelativePath($oldPath);

            if ($newPath) {
                if ($dryRun) {
                    $this->line("   🔍 Would fix [{$user->id}] {$user->name}");
                    $this->line("      From: {$oldPath}");
                    $this->line("      To:   {$newPath}");
                } else {
                    $user->profile_picture_path = $newPath;
                    $user->save();
                    $this->line("   ✅ Fixed [{$user->id}] {$user->name}");
                }
                $fixed++;
            }
        }

        return $fixed;
    }

    /**
     * Extract relative path from full URL
     */
    protected function extractRelativePath(string $url): ?string
    {
        // Remove domain and protocol
        // From: https://sportacademyms.app.avanciafitness.com//photos/students/file.jpg
        // To: photos/students/file.jpg

        // Remove any leading slashes after domain
        $patterns = [
            // Match full URL with double slash
            '#^https?://[^/]+//(.+)$#',
            // Match full URL with single slash
            '#^https?://[^/]+/(.+)$#',
            // Match protocol-relative URL
            '#^//[^/]+/(.+)$#',
        ];

        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $url, $matches)) {
                return $matches[1];
            }
        }

        // If it starts with /, remove it
        if (str_starts_with($url, '/')) {
            return ltrim($url, '/');
        }

        // If it's already a relative path, return as is
        if (!str_contains($url, '://')) {
            return $url;
        }

        return null;
    }
}
