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
use App\Providers\Service\TransaksiService;
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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
