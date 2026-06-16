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
        $this->app->bind(
            \App\Contracts\Services\ProductServiceInterface::class,
            \App\Services\ProductService::class
        );
        $this->app->bind(
            \App\Contracts\Services\CategoryServiceInterface::class,
            \App\Services\CategoryService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
