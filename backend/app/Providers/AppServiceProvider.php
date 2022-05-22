<?php

namespace App\Providers;

use Illuminate\Support\Str;
use App\Library\OrderHandler;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register the order handler
        $this->app->bind(OrderHandler::class, function ($app) {
            return new OrderHandler(request()->get('paymentMethod'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Route::macro('apiResourceFull', function ($uri, $controller) {
            $param = Str::of($uri)->singular()->camel();
            Route::post("{$uri}/{{$param}}/restore", [$controller, 'restore'])->name("{$uri}.restore");
            Route::delete("{$uri}/{{$param}}/force-delete", [$controller, 'forceDelete'])->name("{$uri}.force-delete");
            return Route::apiResource($uri, $controller);
        });
    }
}