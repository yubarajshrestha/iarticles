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
        $this->registerLinksComposer();
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
        $this->loadViewsFrom(__DIR__.'/Views', 'feed');

        $this->app->singleton('iarticles', function() {
            return new iarticles;
        });
    }

    public function registerLinksComposer()
    {
        View::composer('feed::links', function ($view) {
            $view->with('feeds', $this->feeds());
        });
    }

    protected function feeds()
    {
        return collect(config('feed.feeds'))->mapWithKeys(function ($feed, $name) {
            return [$name => $feed['title']];
        });
    }
}
