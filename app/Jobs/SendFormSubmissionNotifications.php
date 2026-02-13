<?php

namespace App\Jobs;

use App\Models\FormSubmission;
use App\Models\Staff;
use App\Models\User;
use App\Mail\FormSubmissionNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class SendFormSubmissionNotifications implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public FormSubmission $formSubmission;
    public int $tries = 5;
    public int $timeout = 120;

    /**
     * Create a new job instance.
     */
    public function __construct(FormSubmission $formSubmission)
    {
        $this->formSubmission = $formSubmission;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $staffEmails = Staff::whereNotNull('email')
                ->pluck('email')
                ->filter()
                ->unique()
                ->toArray();

            // Send to all staff members
            foreach ($staffEmails as $email) {
                try {
                    $this->sendToRecipient($email, 'staff');
                } catch (\Throwable $e) {
                    Log::error('Failed to queue form submission email to staff', [
                        'email' => $email,
                        'form_submission_id' => $this->formSubmission->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            // Always send to the submitter for confirmation
            if ($this->formSubmission->submitter?->email) {
                try {
                    $this->sendToRecipient($this->formSubmission->submitter->email, 'user');
                } catch (\Throwable $e) {
                    Log::error('Failed to queue form submission confirmation email', [
                        'email' => $this->formSubmission->submitter->email,
                        'form_submission_id' => $this->formSubmission->id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            Log::info('Form submission notifications queued', [
                'form_submission_id' => $this->formSubmission->id,
                'staff_recipients' => count($staffEmails),
            ]);
        } catch (\Throwable $e) {
            Log::error('Error sending form submission notifications', [
                'form_submission_id' => $this->formSubmission->id,
                'error' => $e->getMessage(),
            ]);
            throw $e;
        }
    }

    /**
     * Send email to a single recipient.
     */
    private function sendToRecipient(string $email, string $recipientType): void
    {
        if (empty($email)) {
            return;
        }

        // Create or update recipient record
        $recipient = $this->formSubmission->recipients()
            ->firstOrCreate(
                ['recipient_email' => $email],
                ['recipient_type' => $recipientType]
            );

        // Queue the mail
        Mail::to($email)->queue(new FormSubmissionNotification($this->formSubmission, $recipientType));

        // Mark as sent
        $recipient->markAsSent();
    }
}
