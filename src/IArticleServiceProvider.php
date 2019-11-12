<?php

namespace YubarajShrestha\IArticles;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class IArticleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make('YubarajShrestha\IArticles\Controllers\IArticleController');
        
        $this->app->singleton('iarticles', function() {
            return new iarticles;
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        $this->loadViewsFrom(__DIR__.'/Views', 'iarticles');
        $this->publishes([
			__DIR__ . '/Skeleton/config.php' => base_path('config/iarticles.php')
		], 'iarticles');
    }

}
