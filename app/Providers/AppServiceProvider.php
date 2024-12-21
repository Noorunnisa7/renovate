<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\AdminRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Interfaces\LeadsRepositoryInterface;
use App\Repositories\LeadsRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('role', \App\Http\Middleware\RoleMiddleware::class);
        $this->app->bind('checkCache', \App\Http\Middleware\cacheMiddleware::class);

        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(LeadsRepositoryInterface::class, LeadsRepository::class);
     

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
