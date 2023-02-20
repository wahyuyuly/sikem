<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

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
        Blade::component('backend.components.delete', 'delete');
        Blade::component('backend.components.multidelete', 'multidelete');
        Blade::component('backend.components.restore', 'restore');
        Blade::component('backend.components.alert-info', 'alert');
    }
}
