<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ObservableServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Register observers explicitly instead of scanning all model files
        \App\Models\Admin::observe(\App\Observers\AdminObserver::class);
        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Cart::observe(\App\Observers\CartObserver::class);
        \App\Models\Setting::observe(\App\Observers\SettingObserver::class);
    }
}
