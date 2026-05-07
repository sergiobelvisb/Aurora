<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema; // ← Añade esta línea


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
   public function boot(): void
    {
        Schema::defaultStringLength(191);
    }

    public function register(): void
    {
        //
    }
}
