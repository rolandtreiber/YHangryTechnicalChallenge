<?php

namespace App\Providers;

use App\Http\Service\CuisineService;
use App\Http\Service\CuisineServiceImpl;
use App\Http\Service\SetMenuService;
use App\Http\Service\SetMenuServiceImpl;
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
