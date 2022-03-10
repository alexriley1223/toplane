<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('admin', function() {
          return auth()->user() && auth()->user()->role == 2;
        });

        Blade::if('mod', function() {
          return auth()->user() && (auth()->user()->role == 1 || auth()->user()->role == 2);
        });
    }
}
