<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Expense extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'branch_id',
        'user_id',
        'category',
        'description',
        'notes',
        'amount_cents',
        'currency',
        'expense_date',
        'payment_method',
        'receipt_number',
        'vendor_name',
        'status',
        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'expense_date' => 'date',
        'approved_at' => 'datetime',
        'amount_cents' => 'integer',
    ];

    /**
     * Categories for expenses
     */
    public static function categories(): array
    {
        return [
            'transport' => 'Transport',
            'communication' => 'Communication',
            'repair_maintenance' => 'Repair and Maintenance',
            'electricity' => 'Electricity',
            'internet' => 'Internet',
            'website' => 'Website',
            'medical_physio' => 'Medical and Physio',
            'printing' => 'Printing',
            'momo_charges' => 'MoMo Charges',
            'kids_jersey' => 'Kids Jersey',
            'loans' => 'Loans',
            'salary' => 'Salary',
            'salary_advance' => 'Salary Advance',
            'capacity_building' => 'Capacity Building',
            'office_supplies' => 'Office Supplies',
            'office_cleaning' => 'Office Cleaning',
            'cleaning_supplies' => 'Cleaning Supplies',
            'equipments' => 'Equipments',
            'management_system' => 'Management System',
            'invoice' => 'Invoice',
        ];
    }

    /**
     * Payment methods
     */
    public static function paymentMethods(): array
    {
        return [
            'cash' => 'Cash',
            'bank_transfer' => 'Bank Transfer',
            'mobile_money' => 'Mobile Money',
            'card' => 'Card',
            'check' => 'Check',
        ];
    }

    /**
     * Status options
     */
    public static function statuses(): array
    {
        return [
            'pending' => 'Pending',
            'approved' => 'Approved',
            'rejected' => 'Rejected',
            'paid' => 'Paid',
        ];
    }

    /**
     * Get the branch that owns the expense
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the user who recorded the expense
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user who approved the expense
     */
    public function approver(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get amount in RWF (no conversion needed)
     */
    public function getAmountAttribute(): float
    {
        return $this->amount_cents;
    }

    /**
     * Get formatted amount in RWF
     */
    public function getFormattedAmountAttribute(): string
    {
        return number_format($this->amount_cents, 0) . ' ' . $this->currency;
    }
}
