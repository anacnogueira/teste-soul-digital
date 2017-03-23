<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ManageFileServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
    

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Contracts\ManageFile','App\Storage\ManageFile');
    }
}
