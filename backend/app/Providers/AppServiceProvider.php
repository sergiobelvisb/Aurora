<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;

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
        // Compatibilidad MySQL (índices legacy)
        Schema::defaultStringLength(191);

        // 🔥 Forzar HTTPS detrás de ALB (ECS production-safe)
        if (app()->environment('production')) {
            URL::forceScheme('https');
        }
    }
}