<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Fix invalid datetime values in email_verified_at before modifying the table
        // This must run BEFORE add_profile_picture_path_to_users_table
        try {
            DB::statement("UPDATE users SET email_verified_at = NULL WHERE email_verified_at = '0000-00-00 00:00:00' OR email_verified_at < '1970-01-01'");
        } catch (\Exception $e) {
            // If column doesn't exist yet, skip
        }
    }

    public function down(): void
    {
        // No-op for rollback
    }
};
