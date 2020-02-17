<?php

namespace RyanChandler\Shortlinks;

use Illuminate\Support\ServiceProvider;

class ShortlinksServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/shortlinks.php' => config_path('shortlinks.php'),
        ], 'config');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/shortlinks.php', 'shortlinks');

        $this->app->singleton(Shortlinks::class, Shortlinks::class);
    }
}