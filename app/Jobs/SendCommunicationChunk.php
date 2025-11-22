<?php

namespace App\Jobs;

use App\Models\Communication;
use App\Mail\CommunicationSent;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendCommunicationChunk implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Communication $communication;
    public array $emails;

    public int $tries = 3;

    /**
     * Create a new job instance.
     *
     * @param Communication $communication
     * @param array $emails
     */
    public function __construct(Communication $communication, array $emails)
    {
        $this->communication = $communication;
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        foreach ($this->emails as $email) {
            if (empty($email)) {
                continue;
            }

            // Send synchronously inside the queued job so each chunk is processed by the worker.
            Mail::to($email)->send(new CommunicationSent($this->communication));
        }
    }
}
