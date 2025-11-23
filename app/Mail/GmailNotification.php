<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class GmailNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $bodyText;

    /**
     * Create a new message instance.
     */
    public function __construct(string $subjectLine, string $bodyText)
    {
        $this->subjectLine = $subjectLine;
        $this->bodyText = $bodyText;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.gmail_notification')
                    ->with(['body' => $this->bodyText]);
    }
}
