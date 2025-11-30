<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Fix invalid datetime values in users table before modifying the table
        // This must run BEFORE add_profile_picture_path_to_users_table
        try {
            // Fix email_verified_at
            DB::statement("UPDATE users SET email_verified_at = NULL WHERE email_verified_at = '0000-00-00 00:00:00' OR email_verified_at < '1970-01-01'");

            // Fix created_at - set to current timestamp if invalid
            DB::statement("UPDATE users SET created_at = NOW() WHERE created_at = '0000-00-00 00:00:00' OR created_at < '1970-01-01'");

            // Fix updated_at - set to current timestamp if invalid
            DB::statement("UPDATE users SET updated_at = NOW() WHERE updated_at = '0000-00-00 00:00:00' OR updated_at < '1970-01-01'");
        } catch (\Exception $e) {
            // If columns don't exist yet, skip
        }
    }

    public function down(): void
    {
        // No-op for rollback
    }
};
