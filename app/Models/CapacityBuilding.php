<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CapacityBuilding extends Model
{
    use HasFactory;

    protected $table = 'capacity_buildings';

    protected $fillable = [
        'first_name',
        'discipline',
        'second_name',
        'gender',
        'branch',
        'role_function',
        'training_name',
        'institution_name',
        'start_date',
        'end_date',
        'channel',
        'cost_type',
        'cost_amount',
        'training_category',
        'venue',
        'city',
        'country',
    ];
}
