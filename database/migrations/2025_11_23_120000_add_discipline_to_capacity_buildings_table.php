<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('capacity_buildings', function (Blueprint $table) {
            if (! Schema::hasColumn('capacity_buildings', 'discipline')) {
                $table->string('discipline')->nullable()->after('branch');
            }
        });
    }

    public function down()
    {
        Schema::table('capacity_buildings', function (Blueprint $table) {
            if (Schema::hasColumn('capacity_buildings', 'discipline')) {
                $table->dropColumn('discipline');
            }
        });
    }
};
