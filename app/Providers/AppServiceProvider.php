<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Setting;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         $this->app->singleton(Setting::class, function () {
            return Setting::make(storage_path('app/settings.json'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(Config('app.env') !== 'local') 
        {
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
