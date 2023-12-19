<?php

namespace App\Providers;

use App\Policies\TasksPolicy;
use App\Models\Tasks;
use App\Models\TasksUsers;
use App\Policies\TasksUserPolicy;
// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Tasks::class => TasksPolicy::class,
        TasksUsers::class => TasksUserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
