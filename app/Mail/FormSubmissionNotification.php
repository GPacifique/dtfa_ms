<?php

namespace App\Mail;

use App\Models\FormSubmission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\View\Component;

class FormSubmissionNotification extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public FormSubmission $formSubmission;
    public string $recipientType;

    /**
     * Create a new message instance.
     */
    public function __construct(FormSubmission $formSubmission, string $recipientType = 'staff')
    {
        $this->formSubmission = $formSubmission;
        $this->recipientType = $recipientType;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $prefix = match ($this->formSubmission->form_type) {
            'complaint' => '⚠️ NEW COMPLAINT',
            'incident' => '🔴 INCIDENT REPORT',
            'feedback' => '💭 USER FEEDBACK',
            'suggestion' => '💡 SUGGESTION',
            default => '📋 NEW FORM SUBMISSION',
        };

        return new Envelope(
            subject: "{$prefix} - {$this->formSubmission->subject}",
        );
    }

    /**
     * Get the message content definition.
     */
    public function content()
    {
        return $this->view('emails.form-submission', [
            'formSubmission' => $this->formSubmission,
            'recipientType' => $this->recipientType,
        ]);
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
