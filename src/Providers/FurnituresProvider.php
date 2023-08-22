<?php

namespace Fieroo\Furnitures\Providers;

use Illuminate\Support\ServiceProvider;

class FurnituresProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        $this->loadViewsFrom(__DIR__.'/../views', 'furnitures');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        
    }
}