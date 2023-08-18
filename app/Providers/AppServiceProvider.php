<?php

namespace App\Providers;

use App\Services\UserService;
use Illuminate\Routing\Route;
use App\Services\TransaksiService;
use App\Services\BreadcrumbService;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use App\Repositories\TransaksiRepository;
use App\Services\Contracts\UserServiceInterface;
use App\Services\Contracts\TransaksiServiceInterface;
use App\Services\Contracts\BreadcrumbServiceInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\TransaksiRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(TransaksiServiceInterface::class, TransaksiService::class);
        $this->app->bind(TransaksiRepositoryInterface::class, TransaksiRepository::class);
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
