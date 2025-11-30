<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SportsEquipment extends Model
{
    use SoftDeletes;

    protected $table = 'sports_equipment';

    protected $fillable = [
        'name',
        'description',
        'equipment_type',
        'quantity',
        'available_quantity',
        'condition',
        'purchase_price',
        'purchase_date',
        'replacement_cost',
        'location',
        'storage_area',
        'branch_id',
        'status',
        'maintenance_date',
        'maintenance_notes',
        'supplier',
        'reference_code',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'maintenance_date' => 'date',
        'purchase_price' => 'decimal:2',
        'replacement_cost' => 'decimal:2',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available';
    }

    public function isInUse(): bool
    {
        return $this->status === 'in_use';
    }

    public function isUnderMaintenance(): bool
    {
        return $this->status === 'maintenance';
    }

    public function isRetired(): bool
    {
        return $this->status === 'retired';
    }

    public function isLost(): bool
    {
        return $this->status === 'lost';
    }

    public function markAsAvailable(): void
    {
        $this->update(['status' => 'available']);
    }

    public function markAsInUse(): void
    {
        $this->update(['status' => 'in_use']);
    }

    public function markAsUnderMaintenance(): void
    {
        $this->update(['status' => 'maintenance']);
    }

    public function markAsRetired(): void
    {
        $this->update(['status' => 'retired']);
    }

    public function markAsLost(): void
    {
        $this->update(['status' => 'lost']);
    }

    public function getConditionBadgeColor(): string
    {
        return match($this->condition) {
            'excellent' => 'green',
            'good' => 'blue',
            'fair' => 'yellow',
            'poor' => 'orange',
            'damaged' => 'red',
            default => 'gray',
        };
    }

    public function getStatusBadgeColor(): string
    {
        return match($this->status) {
            'available' => 'green',
            'in_use' => 'blue',
            'maintenance' => 'yellow',
            'retired' => 'gray',
            'lost' => 'red',
            default => 'gray',
        };
    }
}
