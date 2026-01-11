<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IncomeCategory extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'icon',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Get all incomes for this category
     */
    public function incomes(): HasMany
    {
        return $this->hasMany(Income::class);
    }

    /**
     * Get only active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get categories ordered by sort_order
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    /**
     * Get total amount received in this category (in cents)
     */
    public function getTotalAmountCentsAttribute(): int
    {
        return $this->incomes()->sum('amount_cents');
    }

    /**
     * Get total amount received this month (in cents)
     */
    public function getMonthlyAmountCentsAttribute(): int
    {
        return $this->incomes()
            ->whereBetween('received_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount_cents');
    }
}
