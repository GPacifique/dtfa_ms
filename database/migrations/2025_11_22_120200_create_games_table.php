<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('games')) {
            Schema::create('games', function (Blueprint $table) {
                $table->id();
                $table->enum('discipline', ['Football', 'Basketball']);
                $table->string('home_team');
                $table->string('home_color')->nullable();
                $table->string('away_team');
                $table->string('away_color')->nullable();
                $table->text('objective')->nullable();
                $table->date('date');
                $table->time('time');
                $table->time('arrival_time')->nullable();
                $table->time('expected_start_time')->nullable();
                $table->time('expected_end_time')->nullable();
                $table->time('expected_return_home_time')->nullable();
                $table->time('departure_time')->nullable();
                $table->time('expected_finish_time')->nullable();
                $table->enum('category', ['In house', 'Friendly', 'League']);
                $table->enum('transport', ['Self', 'Group']);
                $table->string('venue')->nullable();
                $table->json('age_group')->nullable();
                $table->enum('country', ['Rwanda', 'Tanzania']);
                $table->string('city')->nullable();
                $table->string('base')->nullable();
                $table->enum('gender', ['Male', 'Female', 'Mixed']);
                $table->json('staff_ids')->nullable(); // array of staff IDs
                $table->boolean('notify_staff')->default(false);
                $table->json('player_ids')->nullable(); // array of player IDs
                $table->integer('home_score')->nullable();
                $table->integer('away_score')->nullable();
                $table->json('yellow_cards_players')->nullable();
                $table->json('red_cards_players')->nullable();
                $table->json('yellow_cards_staff')->nullable();
                $table->json('red_cards_staff')->nullable();
                $table->text('incidence')->nullable();
                $table->text('technical_feedback')->nullable();
                $table->timestamps();
            });
        }
    }


    public function down()
    {
        Schema::dropIfExists('matches');
    }
};
