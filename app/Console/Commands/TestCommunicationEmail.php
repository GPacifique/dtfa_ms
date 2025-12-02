<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCommunicationEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:communication-email {email? : Email address to send test to}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test the communication email system';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🧪 Testing Communication Email System...');
        $this->newLine();

        // Get test email address
        $email = $this->argument('email') ?: $this->ask('Enter test email address');

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->error('Invalid email address!');
            return 1;
        }

        // Check mail configuration
        $this->info('📧 Mail Configuration:');
        $this->line('  Mailer: ' . config('mail.default'));
        $this->line('  From Address: ' . config('mail.from.address'));
        $this->line('  From Name: ' . config('mail.from.name'));

        if (config('mail.default') === 'smtp') {
            $this->line('  SMTP Host: ' . config('mail.mailers.smtp.host'));
            $this->line('  SMTP Port: ' . config('mail.mailers.smtp.port'));
            $this->line('  SMTP Username: ' . config('mail.mailers.smtp.username'));
        }
        $this->newLine();

        // Create test communication
        $this->info('📝 Creating test communication...');

        $communication = \App\Models\Communication::create([
            'title' => '🧪 Test Email - ' . now()->format('Y-m-d H:i:s'),
            'body' => "This is a test email from the DTFA Management System.\n\n" .
                     "If you receive this email, the communication module is working correctly!\n\n" .
                     "Test Details:\n" .
                     "- Sent at: " . now()->toDateTimeString() . "\n" .
                     "- Environment: " . app()->environment() . "\n" .
                     "- Mail Driver: " . config('mail.default') . "\n\n" .
                     "Best regards,\nDTFA Team",
            'minutes' => 'Test minutes content for validation.',
            'activity_type' => 'Email Test',
            'audience' => 'staff',
            'sender_id' => \App\Models\User::first()?->id ?? 1,
        ]);

        $this->info("✅ Communication created (ID: {$communication->id})");
        $this->newLine();

        // Test different sending methods
        $method = $this->choice(
            'Choose sending method:',
            ['Sync (Immediate)', 'Queue (Background)', 'Direct Mail'],
            0
        );

        $this->info("📤 Sending test email to: {$email}");
        $this->newLine();

        try {
            switch ($method) {
                case 'Sync (Immediate)':
                    // Test synchronous sending
                    \App\Jobs\SendCommunicationChunk::dispatchSync($communication, [$email]);
                    $this->info('✅ Email sent synchronously!');
                    break;

                case 'Queue (Background)':
                    // Test queued sending
                    \App\Jobs\SendCommunicationChunk::dispatch($communication, [$email]);
                    $this->info('✅ Email queued for background processing!');
                    $this->warn('💡 Run "php artisan queue:work" to process the queue');
                    break;

                case 'Direct Mail':
                    // Test direct mailing
                    \Illuminate\Support\Facades\Mail::to($email)->send(new \App\Mail\CommunicationSent($communication));
                    $this->info('✅ Email sent directly!');
                    break;
            }

            $this->newLine();
            $this->info('🎉 Test completed successfully!');
            $this->newLine();

            // Show email preview
            if ($this->confirm('Show email content preview?', true)) {
                $this->newLine();
                $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
                $this->line('Subject: ' . $communication->title);
                $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
                $this->line($communication->body);
                $this->line('━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━');
            }

            // Check logs
            if (config('mail.default') === 'log') {
                $this->newLine();
                $this->warn('📝 Mail driver is set to "log" - check storage/logs/laravel.log for email content');
            }

            return 0;

        } catch (\Exception $e) {
            $this->error('❌ Error sending email: ' . $e->getMessage());
            $this->error('Stack trace: ' . $e->getTraceAsString());
            return 1;
        }
    }
}
