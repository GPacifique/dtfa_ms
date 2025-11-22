<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\TrainingSession;
use App\Policies\TrainingSessionPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        TrainingSession::class => TrainingSessionPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
