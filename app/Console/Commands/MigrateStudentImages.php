<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;

class MigrateStudentImages extends Command
{
    /**
     * The name and signature of the console command.
     * --commit : actually perform file copy and DB updates. Default is dry-run.
     * --limit= : limit number of records processed.
     */
    protected $signature = 'migrate:student-images {--commit : Perform changes} {--limit=0} {--move : Move files instead of copy}';

    protected $description = 'Migrate legacy student image_path to photo_path (copy files to photos/students). Dry-run by default.';

    public function handle()
    {
        $commit = $this->option('commit');
        $limit = (int)$this->option('limit');
        $move = (bool)$this->option('move');

        $query = Student::whereNotNull('image_path')
            ->where(function ($q) {
                $q->whereNull('photo_path')->orWhere('photo_path', '');
            });

        if ($limit > 0) {
            $students = $query->limit($limit)->get();
        } else {
            $students = $query->get();
        }

        if ($students->isEmpty()) {
            $this->info('No students found with legacy image_path needing migration.');
            return 0;
        }

        $this->info('Found ' . $students->count() . ' student(s) to evaluate.');
        $actions = [];

        foreach ($students as $student) {
            $src = ltrim((string)$student->image_path, '/');
            $exists = Storage::disk('public')->exists($src);
            $this->line("ID {$student->id}: src={$src} exists=" . ($exists ? 'yes' : 'no'));

            if (!$exists) {
                $actions[] = [
                    'id' => $student->id,
                    'status' => 'missing_source',
                    'src' => $src,
                ];
                continue;
            }

            $filename = basename($src);
            $dstDir = 'photos/students';
            // ensure unique filename to avoid overwrites
            $dst = $dstDir . '/' . uniqid() . '_' . $filename;

            $actions[] = [
                'id' => $student->id,
                'src' => $src,
                'dst' => $dst,
                'status' => 'ok',
            ];

            if ($commit) {
                // perform copy (or move)
                try {
                    if ($move) {
                        Storage::disk('public')->move($src, $dst);
                    } else {
                        Storage::disk('public')->copy($src, $dst);
                    }
                    $student->photo_path = $dst;
                    $student->save();
                    $this->info(" -> migrated to {$dst}");
                } catch (\Throwable $e) {
                    $this->error("Failed to migrate ID {$student->id}: {$e->getMessage()}");
                }
            } else {
                $this->line(" -> dry-run would copy to {$dst}");
            }
        }

        $this->info('Done. Summary:');
        $counts = collect($actions)->countBy('status')->toArray();
        foreach ($counts as $k => $v) {
            $this->info("  {$k}: {$v}");
        }

        if (!$commit) {
            $this->info('Dry-run mode. Rerun with --commit to perform changes.');
        }

        return 0;
    }
}
