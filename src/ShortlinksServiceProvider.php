<?php

namespace RyanChandler\Shortlinks;

use Illuminate\Support\ServiceProvider;

class ShortlinksServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Shortlinks::class, Shortlinks::class);
    }
}