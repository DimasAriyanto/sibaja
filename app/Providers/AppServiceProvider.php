<?php

namespace App\Providers;

use App\Services\UserService;
use App\Services\BreadcrumbService;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\UserServiceInterface;
use App\Services\Contracts\BreadcrumbServiceInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Foundation\Application;
use Illuminate\Routing\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(BreadcrumbServiceInterface::class, function (Application $app) {
            return new BreadcrumbService($app->make(Route::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
