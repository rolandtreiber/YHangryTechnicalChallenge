<?php

namespace App\Providers;

use App\Service\CuisineService;
use App\Service\CuisineServiceImpl;
use App\Service\SetMenuService;
use App\Service\SetMenuServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SetMenuService::class, function () {
            return new SetMenuServiceImpl();
        });
        $this->app->singleton(CuisineService::class, function () {
            return new CuisineServiceImpl();
        });
    }

}
