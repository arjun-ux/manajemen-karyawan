<?php

namespace App\Providers;

use App\Providers\Service\SantriService;
use App\Providers\RouteParamService;
use App\Providers\Service\IndoRegionService;
use App\Providers\Service\UserService;
use App\Providers\Service\WhatsAppService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //santri
        $this->app->singleton(SantriService::class, function($app){
            return new SantriService($app);
        });
        // route encripsi
        $this->app->singleton(RouteParamService::class, function($app){
            return new RouteParamService($app);
        });
        // indoregion
        $this->app->singleton(IndoRegionService::class, function($app){
            return new IndoRegionService($app);
        });
        // whatsApp
        $this->app->singleton(WhatsAppService::class, function($app){
            return new WhatsAppService($app);
        });
        // user service
        $this->app->singleton(UserService::class, function($app){
            return new UserService($app);
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
