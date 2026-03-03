<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class TrainingEquipmentRequest extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'training_session_id',
        'inhouse_training_id',
        'equipment_type',
        'equipment_id',
        'quantity_requested',
        'quantity_approved',
        'status',
        'purpose',
        'notes',
        'requested_by',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'quantity_requested' => 'integer',
        'quantity_approved' => 'integer',
    ];

    /* ─── Relationships ─────────────────────────────────────────────── */

    public function trainingSession(): BelongsTo
    {
        return $this->belongsTo(TrainingSession::class);
    }

    public function inhouseTraining(): BelongsTo
    {
        return $this->belongsTo(InhouseTraining::class);
    }

    public function requestedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function usageReport(): HasOne
    {
        return $this->hasOne(EquipmentUsageReport::class);
    }

    /* ─── Dynamic Equipment Resolution ─────────────────────────────── */

    /**
     * Get the actual equipment model instance based on equipment_type.
     */
    public function getEquipmentAttribute(): ?Model
    {
        return match ($this->equipment_type) {
            'sports'  => SportsEquipment::find($this->equipment_id),
            'office'  => OfficeEquipment::find($this->equipment_id),
            default   => Equipment::find($this->equipment_id),
        };
    }

    public function getEquipmentNameAttribute(): string
    {
        return $this->equipment?->name ?? 'Unknown Equipment';
    }

    /* ─── Scopes ────────────────────────────────────────────────────── */

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeFulfilled($query)
    {
        return $query->where('status', 'fulfilled');
    }

    /* ─── Helpers ───────────────────────────────────────────────────── */

    public function getStatusBadgeColor(): string
    {
        return match ($this->status) {
            'pending'   => 'yellow',
            'approved'  => 'blue',
            'rejected'  => 'red',
            'fulfilled' => 'green',
            'returned'  => 'gray',
            default     => 'gray',
        };
    }

    public function getTrainingLabel(): string
    {
        if ($this->trainingSession) {
            return "Training Session #{$this->training_session_id} ({$this->trainingSession->date?->format('d M Y')})";
        }
        if ($this->inhouseTraining) {
            return $this->inhouseTraining->training_name ?? "Inhouse Training #{$this->inhouse_training_id}";
        }
        return 'Unknown Training';
    }
}
