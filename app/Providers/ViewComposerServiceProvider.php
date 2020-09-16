<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Notification;
use Auth;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->composer('app', function($view){
        //     $user_id = Auth::user()->id;
        //     $notif = Notification::find($user_id)->get();
        //     // dd($notif);
        //     $view->with('base_url', $notif->base_url);
        // });
    }
}
