<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FormSubmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'form_type',
        'subject',
        'message',
        'form_data',
        'status',
        'notes',
        'assigned_to',
        'read_at',
        'responded_at',
    ];

    protected $casts = [
        'form_data' => 'array',
        'read_at' => 'datetime',
        'responded_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the user who submitted the form.
     */
    public function submitter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the staff member assigned to this submission.
     */
    public function assignedStaff(): BelongsTo
    {
        return $this->belongsTo(Staff::class, 'assigned_to');
    }

    /**
     * Get all recipients of this form submission.
     */
    public function recipients(): HasMany
    {
        return $this->hasMany(FormSubmissionRecipient::class);
    }

    /**
     * Mark as read.
     */
    public function markAsRead()
    {
        $this->update(['read_at' => now()]);
    }

    /**
     * Mark as responded.
     */
    public function markAsResponded()
    {
        $this->update(['responded_at' => now(), 'status' => 'acknowledged']);
    }

    /**
     * Mark as resolved.
     */
    public function markAsResolved()
    {
        $this->update(['status' => 'resolved', 'responded_at' => now()]);
    }

    /**
     * Get display name for form type.
     */
    public function getFormTypeLabel(): string
    {
        return match ($this->form_type) {
            'contact' => 'Contact Form',
            'complaint' => 'Complaint',
            'feedback' => 'Feedback',
            'incident' => 'Incident Report',
            'suggestion' => 'Suggestion',
            'other' => 'Other',
            default => ucfirst($this->form_type),
        };
    }

    /**
     * Get display name for status.
     */
    public function getStatusLabel(): string
    {
        return match ($this->status) {
            'received' => 'Received',
            'read' => 'Read',
            'acknowledged' => 'Acknowledged',
            'resolved' => 'Resolved',
            default => ucfirst($this->status),
        };
    }
}
