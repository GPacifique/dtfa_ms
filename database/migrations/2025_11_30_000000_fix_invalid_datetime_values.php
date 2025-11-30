<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        // Fix invalid datetime values in email_verified_at before modifying the table
        DB::statement("UPDATE users SET email_verified_at = NULL WHERE email_verified_at = '0000-00-00 00:00:00' OR email_verified_at IS NOT NULL AND email_verified_at < '1970-01-01'");
    }

    public function down(): void
    {
        // No-op for rollback
    }
};
