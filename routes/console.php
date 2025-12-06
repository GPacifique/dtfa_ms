<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\Communication;
use App\Jobs\SendCommunicationChunk;

// Mailtrap API test sender: php artisan send-mail
// Requires: composer require mailtrap/mailtrap-php
// .env: MAILTRAP_API_TOKEN=... and optionally MAILTRAP_TO=you@example.com
Artisan::command('send-mail', function () {
    try {
        if (!class_exists(\Mailtrap\MailtrapClient::class)) {
            $this->error('Mailtrap SDK not installed. Run: composer require mailtrap/mailtrap-php');
            return 1;
        }

        $apiKey = env('MAILTRAP_API_TOKEN');
        if (!$apiKey) {
            $this->error('Missing MAILTRAP_API_TOKEN in .env');
            return 1;
        }

        $to = env('MAILTRAP_TO', 'gashumba@gmail.com');
        $from = env('MAIL_FROM_ADDRESS', 'gashumbaaimable@gmail.com');
        $fromName = env('MAIL_FROM_NAME', 'DTFA');

        $email = (new \Mailtrap\Mime\MailtrapEmail())
            ->from(new \Symfony\Component\Mime\Address($from, $fromName))
            ->to(new \Symfony\Component\Mime\Address($to))
            ->subject('You are awesome!')
            ->category('Integration Test')
            ->text('Congrats for sending test email with Mailtrap!');

        $client = \Mailtrap\MailtrapClient::initSendingEmails(apiKey: $apiKey);
        $response = $client->send($email);

        $arr = \Mailtrap\Helper\ResponseHelper::toArray($response);
        $this->info('Mailtrap response:');
        $this->line(json_encode($arr, JSON_PRETTY_PRINT));
        return 0;
    } catch (\Throwable $e) {
        $this->error('Failed to send: ' . $e->getMessage());
        return 1;
    }
})->purpose('Send a test email via Mailtrap API');

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule auto game status updates every minute
Schedule::command('games:auto-update-status')->everyMinute();

// Auto-send pending communications to staff every 5 minutes
Schedule::call(function () {
    $pending = Communication::query()
        ->whereNull('sent_at')
        ->orderBy('id', 'asc')
        ->limit(25)
        ->get();

    foreach ($pending as $communication) {
        // Determine recipients based on audience; for now, gather staff emails
        $emails = \App\Models\User::query()
            ->whereHas('roles', function ($q) {
                $q->whereIn('name', ['staff', 'coach', 'admin']);
            })
            ->whereNotNull('email')
            ->pluck('email')
            ->filter()
            ->unique()
            ->values()
            ->toArray();

        // Chunk emails for queue load distribution
        $chunks = array_chunk($emails, 50);
        foreach ($chunks as $chunk) {
            dispatch(new SendCommunicationChunk($communication, $chunk));
        }

        // Mark as sent to avoid re-sending; actual delivery is queued
        $communication->forceFill(['sent_at' => now()])->save();
    }
})->everyFiveMinutes();
