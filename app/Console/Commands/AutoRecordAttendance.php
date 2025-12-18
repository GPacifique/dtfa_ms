<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Admin\StudentAttendanceController;

class AutoRecordAttendance extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'attendance:auto-record';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically record attendance for all active students';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting auto-record attendance...');

        $controller = new StudentAttendanceController();
        $recorded = $controller->autoRecordToday();

        $this->info("Auto-recorded attendance for {$recorded} students.");

        return Command::SUCCESS;
    }
}
