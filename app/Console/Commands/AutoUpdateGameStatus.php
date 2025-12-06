<?php

namespace App\Console\Commands;

use App\Models\Game;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;

class AutoUpdateGameStatus extends Command
{
    protected $signature = 'games:auto-update-status';
    protected $description = 'Automatically start and complete matches based on scheduled times';

    public function handle(): int
    {
        $now = Carbon::now();

        // Start scheduled games when current time is at or after the match time
        $toStart = Game::query()
            ->where('status', 'scheduled')
            ->whereDate('date', '<=', $now->toDateString())
            ->whereTime('time', '<=', $now->format('H:i:s'))
            ->get();

        foreach ($toStart as $game) {
            // Use model helper if exists, otherwise update directly
            if (method_exists($game, 'startMatch')) {
                $game->startMatch();
            } else {
                $game->update(['status' => 'in_progress']);
            }
        }

        // Complete in-progress games when expected_finish_time has passed (fallback to time + 2h if null)
        $toComplete = Game::query()
            ->where('status', 'in_progress')
            ->get();

        foreach ($toComplete as $game) {
            $finishAt = null;
            try {
                if (!empty($game->expected_finish_time)) {
                    // Build finishAt safely from date + expected_finish_time
                    $finishAt = Carbon::parse($game->date)->startOfDay()
                        ->setTimeFromTimeString($game->expected_finish_time);
                } elseif (!empty($game->time)) {
                    // Fallback: assume 2 hours duration from start time
                    $startAt = Carbon::parse($game->date)->startOfDay()
                        ->setTimeFromTimeString($game->time);
                    $finishAt = $startAt->copy()->addHours(2);
                }
            } catch (\Throwable $e) {
                // Skip malformed times
                $this->warn('Skip game '.$game->id.' due to time parse error: '.$e->getMessage());
                continue;
            }

            if ($finishAt && $now->greaterThanOrEqualTo($finishAt)) {
                if (method_exists($game, 'completeMatch')) {
                    $game->completeMatch();
                } else {
                    $game->update(['status' => 'completed']);
                }
            }
        }

        $this->info(sprintf('Auto update done: started %d, checked %d in-progress', $toStart->count(), $toComplete->count()));
        return Command::SUCCESS;
    }
}
