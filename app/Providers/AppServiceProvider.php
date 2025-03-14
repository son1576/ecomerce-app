<?php

namespace App\Providers;

use App\Models\GeneralSetting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrap();

        if (Schema::hasTable('general_settings')) {
            $generalSetting = GeneralSetting::first();

            /** Set time zone */
            Config::set('app.timezone', $generalSetting->time_zone);
        } else {
            $generalSetting = [
                
            ];
        }


        /** Share variable at all view */
        View::composer('*', function ($view) use ($generalSetting) {
            $view->with('settings', $generalSetting);
        });
    }
}
