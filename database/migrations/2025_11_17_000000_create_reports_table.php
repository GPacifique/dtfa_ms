<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('reports')) {
            Schema::create('reports', function (Blueprint $table) {
                $table->bigIncrements('id'); // Laravel default primary key
                $table->integer('no')->unique();
                $table->enum('workstream', ['SPORTING', 'BUSINESS', 'ADMINISTRATION', 'TECHNOLOGY']);
                $table->string('activity');
                $table->enum('status', ['RED', 'YELLOW', 'GREEN']);
                $table->text('comments')->nullable();
                $table->timestamps();
            });
        }
    }
};

