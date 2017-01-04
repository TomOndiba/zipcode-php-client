<?php

namespace Codenexus\Zipcode\Laravel;

use Illuminate\Support\ServiceProvider;
use Codenexus\Zipcode\Zipcode;

class ZipcodeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('zipcode', function ($app) {
            return new Zipcode;
        });
    }
}
