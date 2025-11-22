<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Communication;

class CommunicationSent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $communication;

    public function __construct(Communication $communication)
    {
        $this->communication = $communication;
    }

    public function build()
    {
        return $this->from('gashumbaaimable@gmail.com', 'DTFA')
            ->subject($this->communication->title)
            ->view('emails.communication')
            ->with(['communication' => $this->communication]);
    }
}
