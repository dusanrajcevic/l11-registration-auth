<?php

namespace App\Providers;

use App\Services\RegistrationService;
use App\Services\RegistrationServiceContract;
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
        $this->app->bind(RegistrationServiceContract::class, RegistrationService::class);
    }
}
