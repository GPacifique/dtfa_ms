<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EquipmentUsageReport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'training_equipment_request_id',
        'training_session_id',
        'inhouse_training_id',
        'equipment_type',
        'equipment_id',
        'quantity_used',
        'quantity_returned',
        'quantity_damaged',
        'quantity_lost',
        'equipment_condition_after',
        'usage_summary',
        'issues_encountered',
        'recommendations',
        'reported_by',
        'reported_at',
    ];

    protected $casts = [
        'reported_at'       => 'datetime',
        'quantity_used'     => 'integer',
        'quantity_returned' => 'integer',
        'quantity_damaged'  => 'integer',
        'quantity_lost'     => 'integer',
    ];

    /* ─── Relationships ─────────────────────────────────────────────── */

    public function equipmentRequest(): BelongsTo
    {
        return $this->belongsTo(TrainingEquipmentRequest::class, 'training_equipment_request_id');
    }

    public function trainingSession(): BelongsTo
    {
        return $this->belongsTo(TrainingSession::class);
    }

    public function inhouseTraining(): BelongsTo
    {
        return $this->belongsTo(InhouseTraining::class);
    }

    public function reportedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    /* ─── Dynamic Equipment Resolution ─────────────────────────────── */

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

    /* ─── Helpers ───────────────────────────────────────────────────── */

    public function getConditionBadgeColor(): string
    {
        return match ($this->equipment_condition_after) {
            'excellent' => 'green',
            'good'      => 'blue',
            'fair'      => 'yellow',
            'poor'      => 'orange',
            'damaged'   => 'red',
            default     => 'gray',
        };
    }

    public function hasLosses(): bool
    {
        return $this->quantity_damaged > 0 || $this->quantity_lost > 0;
    }
}
