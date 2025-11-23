<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\GmailNotification;
use App\Models\User;

class SendGmailNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * Usage: php artisan send:gmail-notification "Subject" --body="Message body" --to=all
     */
    protected $signature = 'send:gmail-notification {subject} {--body=} {--to=all}';

    /**
     * The console command description.
     */
    protected $description = 'Send a Gmail notification to users (use --to=all or comma-separated emails)';

    public function handle()
    {
        $subject = $this->argument('subject');
        $body = $this->option('body') ?? $this->ask('Enter message body');
        $to = $this->option('to') ?? 'all';

        $emails = [];
        if (strtolower($to) === 'all') {
            $emails = User::whereNotNull('email')->pluck('email')->filter()->unique()->toArray();
        } else {
            $emails = array_map('trim', explode(',', $to));
        }

        if (empty($emails)) {
            $this->error('No recipient emails found.');
            return 1;
        }

        $bar = $this->output->createProgressBar(count($emails));
        $bar->start();

        foreach ($emails as $email) {
            try {
                Mail::to($email)->send(new GmailNotification($subject, $body));
            } catch (\Throwable $e) {
                $this->line("\nFailed to send to {$email}: {$e->getMessage()}");
            }
            $bar->advance();
        }

        $bar->finish();
        $this->info('\nDone.');

        return 0;
    }
}
