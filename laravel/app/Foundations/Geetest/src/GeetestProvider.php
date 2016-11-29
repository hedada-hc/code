<?php

namespace Yunxi\Geetest;

use Illuminate\Support\ServiceProvider;

class GeetestProvider extends ServiceProvider
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
        $this->app->singleton('geetest', function(){
            return new \Yunxi\Geetest\Geetest();
        });
    }
}
