<?php

namespace App\Providers;

use App\Repository\CuisineRepository;
use App\Repository\CuisineRepositoryImpl;
use App\Repository\SetMenuRepository;
use App\Repository\SetMenuRepositoryImpl;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(CuisineRepository::class, function () {
            return new CuisineRepositoryImpl();
        });
        $this->app->singleton(SetMenuRepository::class, function () {
            return new SetMenuRepositoryImpl();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
