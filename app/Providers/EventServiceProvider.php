<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            \App\Listeners\AssignRoleByBranch::class,
        ],
        Verified::class => [
            \App\Listeners\SendAccountVerifiedNotification::class,
        ],
    ];
}
