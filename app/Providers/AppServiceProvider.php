<?php

namespace App\Providers;

use App\Models\Impact;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.app', 'dashboard.layouts.app'], function ($view) {
            $view->with('route', Route::currentRouteName());
        });

        View::composer(['search.section'], function ($view) {
            // Initialize highlighted impacts for search && default values for search results
            $view->with('highlightedImpacts', Impact::where('highlight', true)->orderBy('title')->get())
                ->with('searchProducts', Product::orderBy('name')->take(6)->get())
                ->with('searchResearches', [])
                ->with('resultsCount', 6);
        });
    }
}