<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'income_category_id',
        'amount_cents',
        'currency',
        'category', // kept for backward compatibility
        'source',
        'received_at',
        'notes',
        'recorded_by_user_id',
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'amount_cents' => 'integer',
    ];

    /**
     * Get the branch that owns the income
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the user who recorded the income
     */
    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by_user_id');
    }

    /**
     * Get the income category
     */
    public function incomeCategory(): BelongsTo
    {
        return $this->belongsTo(IncomeCategory::class);
    }

    /**
     * Get category name (from relationship or legacy field)
     */
    public function getCategoryNameAttribute(): string
    {
        if ($this->incomeCategory) {
            return $this->incomeCategory->name;
        }
        // Fallback to legacy category field
        return ucfirst(str_replace('_', ' ', $this->category ?? 'Other'));
    }

    /**
     * Get all income categories from the database
     */
    public static function categories(): array
    {
        return IncomeCategory::active()
            ->ordered()
            ->pluck('name', 'id')
            ->toArray();
    }

    /**
     * Get amount in currency format
     */
    public function getAmountAttribute(): float
    {
        return $this->amount_cents;
    }

    /**
     * Get formatted amount
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount_cents, 0) . ' ' . $this->currency;
    }
}
