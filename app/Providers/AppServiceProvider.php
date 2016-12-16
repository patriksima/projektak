<?php

namespace App\Providers;

use Parsedown;
use App\Helpers\FilterHelper;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->singleton('filter', function () {
            return new FilterHelper;
        });

        app()->singleton('Parsedown', function () {
            return new Parsedown;
        });
    }
}
