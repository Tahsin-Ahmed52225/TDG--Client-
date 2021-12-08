<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Project;

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
        view()->composer('client.*', function ($view) {
            $view->with('clientProject', Project::clientProject());
        });
    }
}
