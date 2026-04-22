<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Player;

class ParentModel extends Model
{
    use HasFactory;

    protected $table = 'parents';

    protected $fillable = [
        'user_id',
        'phone',
        'address',
    ];

    /**
     * Parent belongs to a User account
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Parent has many players (children)
     */
    public function players()
    {
        return $this->hasMany(Player::class, 'parent_id');
    }
}