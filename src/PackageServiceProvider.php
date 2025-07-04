<?php

namespace Cone\Package;

use Illuminate\Support\ServiceProvider;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

            $this->commands([
                //
            ]);

            $this->publishes([
                __DIR__.'/../config/package-name.php' => $this->app->configPath('package-name.php'),
            ], 'package-name-config');

            $this->publishes([
                __DIR__.'/../resources/views' => $this->app->resourcePath('views/vendor/package-name'),
            ], 'package-name-views');
        }

        $this->loadViewsFrom(__DIR__.'/../resources/views', 'package-name');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}
