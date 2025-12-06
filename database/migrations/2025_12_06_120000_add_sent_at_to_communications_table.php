<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('communications') && !Schema::hasColumn('communications', 'sent_at')) {
            Schema::table('communications', function (Blueprint $table) {
                $table->timestamp('sent_at')->nullable()->after('audience');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('communications') && Schema::hasColumn('communications', 'sent_at')) {
            Schema::table('communications', function (Blueprint $table) {
                $table->dropColumn('sent_at');
            });
        }
    }
};
