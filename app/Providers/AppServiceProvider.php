<?php

namespace App\Providers;

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

    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer(['layouts.app', 'dashboard'], function ($view) {
            $view->with('fxRates', \App\Models\FxRate::latest()->take(10)->get());
            $view->with('metalPrices', \App\Models\MetalPrice::latest()->take(5)->get());
        });
    }
}
