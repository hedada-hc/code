<?php

namespace Yunxi\Alidayu;

use Illuminate\Support\ServiceProvider;

class AlidayuProvider extends ServiceProvider
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
        $this->app->singleton('alidayu', function(){
            return new \Yunxi\Alidayu\Alidayu();
        });
    }
}
