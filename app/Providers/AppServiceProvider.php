<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\DailyProductionRecord;
use App\Observers\DailyProductionRecordObserver;

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
        DailyProductionRecord::observe(DailyProductionRecordObserver::class);
    }
}
