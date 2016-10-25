<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-access', function ($user) {
            return $user->hasRole('admin');
        });

        Gate::define('manager-access', function ($user) {
            return $user->hasRole('manager');
        });

        Gate::define('worker-access', function ($user) {
            return $user->hasRole('worker');
        });
    }
}
