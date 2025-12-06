<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Communication extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'body',
        'sender_id',
        'minutes',
        'activity_type',
        'audience',
        'sent_at',
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
