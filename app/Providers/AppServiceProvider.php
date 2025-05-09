<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register admin routes
        $this->app->bind('App\Http\Controllers\Admin\SettingController');
        $this->app->bind('App\Http\Controllers\Admin\MessageController');
        $this->app->bind('App\Http\Controllers\Admin\PurchaseController');
    }
}
