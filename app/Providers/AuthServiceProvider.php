<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\Facades\Gate;
use App\Services\Auth\OurGuard;
use App\Extensions\UserProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
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

        Auth::extend('our_guard', function ($app, $name, array $config) {
            $provider = new UserProvider($this->app['hash'], $this->app['config']['auth.providers.'.$config['provider'].'.model']);

            return new OurGuard($name, $provider, $this->app['session.store'], $app->request);
        });

        Auth::provider('our_provider', function ($app, array $config) {
            return new UserProvider($this->app['hash'], $config['model']);
        });
    }
}
