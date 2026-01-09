<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Only run MySQL-specific commands on MySQL connections
        if (DB::connection()->getDriverName() !== 'mysql') {
            return;
        }

        // Disable strict mode temporarily to allow adding column with invalid datetime values present
        DB::statement("SET sql_mode = ''");

        try {
            // Fix invalid datetime values in users table
            DB::statement("UPDATE users SET email_verified_at = NULL WHERE email_verified_at = '0000-00-00 00:00:00' OR email_verified_at < '1970-01-01' OR email_verified_at IS NOT NULL AND CAST(email_verified_at AS CHAR) REGEXP '^0000'");

            DB::statement("UPDATE users SET created_at = NOW() WHERE created_at = '0000-00-00 00:00:00' OR created_at < '1970-01-01' OR created_at IS NOT NULL AND CAST(created_at AS CHAR) REGEXP '^0000'");

            DB::statement("UPDATE users SET updated_at = NOW() WHERE updated_at = '0000-00-00 00:00:00' OR updated_at < '1970-01-01' OR updated_at IS NOT NULL AND CAST(updated_at AS CHAR) REGEXP '^0000'");
        } catch (\Exception $e) {
            // Continue anyway
        } finally {
            // Re-enable strict mode
            DB::statement("SET sql_mode = 'STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION'");
        }
    }

    public function down(): void
    {
        // No rollback needed
    }
};
