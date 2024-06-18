<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Firebases;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Firebases::class, function ($app) {
            return new Firebases();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
