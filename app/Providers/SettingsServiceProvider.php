<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class SettingsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view){
            $user = Auth::user();
            $user_img_path = !empty($user->image) ? 
                "storage/users/".$user->image :
                "img/avatar.png";
             $view->with('user_img_path', $user_img_path);

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
