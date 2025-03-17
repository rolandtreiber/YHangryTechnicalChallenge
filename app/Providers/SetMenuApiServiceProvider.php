<?php

namespace App\Providers;

use App\Repository\CuisineRepositoryImpl;
use App\Repository\SetMenuRepositoryImpl;
use App\Service\ApiDataHandlerService;
use App\Service\ApiDataHandlerServiceImpl;
use App\Service\SetMenuApiService;
use App\Service\SetMenuApiServiceImpl;
use Illuminate\Support\ServiceProvider;

class SetMenuApiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(SetMenuApiService::class, function ($app) {
            return new SetMenuApiServiceImpl(config('app.set_menu_api'));
        });
        $this->app->singleton(ApiDataHandlerService::class, function ($app) {
            return new ApiDataHandlerServiceImpl(
                new SetMenuApiServiceImpl(config('app.set_menu_api')),
                new CuisineRepositoryImpl(),
                new SetMenuRepositoryImpl());
        });
    }
}
