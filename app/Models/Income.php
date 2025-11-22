<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id', 'amount_cents', 'currency', 'category', 'source', 'received_at', 'notes', 'recorded_by_user_id',
    ];

    protected $casts = [
        'received_at' => 'datetime',
        'amount_cents' => 'integer',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function recordedBy()
    {
        return $this->belongsTo(User::class, 'recorded_by_user_id');
    }
}
