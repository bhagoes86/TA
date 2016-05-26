<?php

namespace App\Providers;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('posyandu.template', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.ibu.index', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.ibu.create', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.ibu.edit', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });
        
        view()->composer('posyandu.balita.index', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.balita.create', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.balita.edit', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.penimbangan.index', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.penimbangan.create', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.akunibu.index', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.pengumuman.index', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.pengumuman.create', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.pengumuman.edit', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.keluhan.index', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.beriimunisasi.create', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.kapsul.create', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.kas.index', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.kas.create', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.kas.edit', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.pengurus.index', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.pengurus.create', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.pengurus.edit', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.absen.index', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.absen.create', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });

        view()->composer('posyandu.absen.edit', function($view) {
            $view->with('Sentinel', Sentinel::getUser());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
