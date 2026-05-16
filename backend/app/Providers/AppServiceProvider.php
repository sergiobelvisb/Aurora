<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; 
use Illuminate\Support\Fecades\URL;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
   public function boot(): void
    {
       // URL::forceScheme('https');
        Schema::defaultStringLength(191);
    }

    public function register(): void
    {
        //
    }
}
