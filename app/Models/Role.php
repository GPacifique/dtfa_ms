<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    // Allow mass assignment
    protected $fillable = [
        'name',
        'guard_name',
    ];
}
