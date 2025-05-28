<?php

namespace App\Providers;

use Laravel\Sanctum\Sanctum;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;

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
    Paginator::useBootstrapFive();
     Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
    }
}
