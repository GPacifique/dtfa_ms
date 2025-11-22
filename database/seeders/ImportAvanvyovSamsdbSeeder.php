<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportAvanvyovSamsdbSeeder extends Seeder
{
    /**
     * Run the database import from SQL dump.
     */
    public function run(): void
    {
        $path = database_path('seeders/sql/avanvyov_samsdb.sql');

        if (! File::exists($path)) {
            $this->command->error("SQL dump not found at: {$path}");
            return;
        }

        $this->command->info('Reading SQL dump: ' . $path);
        $sql = File::get($path);

        // Disable foreign key checks for the import and re-enable afterwards
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        try {
            DB::unprepared($sql);
            $this->command->info('SQL import completed successfully.');
        } catch (\Throwable $e) {
            $this->command->error('SQL import failed: ' . $e->getMessage());
            throw $e;
        } finally {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
