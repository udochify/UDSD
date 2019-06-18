<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['*.index', 'blog.*', 'page.*', 'auth.*', 'admin.auth.*', 'ajax.blog.*', 'ajax.home.*', 'sections.*', 'partials.*', 'widgets.*'], 'App\Http\Composers\ViewComposer');

        // Using Closure based composers...
        View::composer('*', function($view) {

        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
