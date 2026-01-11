<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExpenseCategory extends Model
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
     * Get all expenses for this category
     */
    public function expenses(): HasMany
    {
        return $this->hasMany(Expense::class);
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
     * Get total amount spent in this category (in cents)
     */
    public function getTotalAmountCentsAttribute(): int
    {
        return $this->expenses()
            ->whereIn('status', ['approved', 'paid'])
            ->sum('amount_cents');
    }

    /**
     * Get total amount spent this month (in cents)
     */
    public function getMonthlyAmountCentsAttribute(): int
    {
        return $this->expenses()
            ->whereIn('status', ['approved', 'paid'])
            ->whereBetween('expense_date', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('amount_cents');
    }
}
