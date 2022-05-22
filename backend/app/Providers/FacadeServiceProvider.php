<?php

namespace App\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        App::bind('helper', function () {
            return new \App\Helpers\Helper;
        });

        App::bind('config-helper', function () {
            return new \App\Helpers\ConfigHelper;
        });

        App::bind('response', function () {
            return new \App\Helpers\Response;
        });
    }
}