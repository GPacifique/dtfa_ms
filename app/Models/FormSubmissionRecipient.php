<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormSubmissionRecipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'form_submission_id',
        'recipient_email',
        'recipient_type',
        'sent_at',
        'delivered_at',
        'opened_at',
        'error_message',
        'retry_count',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
        'delivered_at' => 'datetime',
        'opened_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the form submission.
     */
    public function formSubmission(): BelongsTo
    {
        return $this->belongsTo(FormSubmission::class);
    }

    /**
     * Mark as sent.
     */
    public function markAsSent()
    {
        $this->update(['sent_at' => now()]);
    }

    /**
     * Mark as delivered.
     */
    public function markAsDelivered()
    {
        $this->update(['delivered_at' => now()]);
    }

    /**
     * Mark as opened.
     */
    public function markAsOpened()
    {
        $this->update(['opened_at' => now()]);
    }

    /**
     * Mark as failed with error.
     */
    public function markAsFailed(string $error)
    {
        $this->update([
            'error_message' => $error,
            'retry_count' => $this->retry_count + 1,
        ]);
    }
}
