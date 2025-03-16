<?php

namespace App\Providers;

use App\Http\Service\SetMenuApiService;
use App\Http\Service\SetMenuApiServiceImpl;
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
    }
}
