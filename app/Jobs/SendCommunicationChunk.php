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
            try {
                // Queue each mailable separately so mail delivery is decoupled from chunk processing.
                Mail::to($email)->queue(new CommunicationSent($this->communication));
            } catch (\Throwable $e) {
                // Log and continue so one failing address doesn't stop the chunk
                \Log::error('Failed to queue communication email', [
                    'email' => $email,
                    'communication_id' => $this->communication->id ?? null,
                    'error' => $e->getMessage(),
                ]);
                continue;
            }
        }
    }
}
