<?php

namespace App\Providers;

use App\Providers\Service\SantriService;
use App\Providers\RouteParamService;
use App\Providers\Service\IndoRegionService;
use App\Providers\Service\InvoiceService;
use App\Providers\Service\PdfService;
use App\Providers\Service\PekerjaanService;
use App\Providers\Service\PendidikanService;
use App\Providers\Service\SettingsService;
use App\Providers\Service\UserService;
use App\Providers\Service\WhatsAppService;
use Illuminate\Support\ServiceProvider;
use Psy\CodeCleaner\ReturnTypePass;

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
        // pendidikan
        $this->app->singleton(PendidikanService::class, function($app){
            return new PendidikanService($app);
        });
        // pekerjaan
        $this->app->singleton(PekerjaanService::class, function($app){
            return new PekerjaanService($app);
        });
        // pdf
        $this->app->singleton(PdfService::class, function($app){
            return new PdfService($app);
        });
        // settings pesantren
        $this->app->singleton(SettingsService::class, function($app){
            return new SettingsService($app);
        });
        // invoice
        $this->app->singleton(InvoiceService::class, function($app){
            return new InvoiceService($app);
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
