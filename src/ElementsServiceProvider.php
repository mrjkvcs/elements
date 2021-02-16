<?php

namespace JKL\Elements;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use JKL\View\Components\Input;

class ElementsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'jkl');
        $this->loadViewsFrom(__DIR__ . '/../resources/views/components', 'elements');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        Blade::component('elements::input', 'jkl::input');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/elements.php', 'elements');

        // Register the service the package provides.
        $this->app->singleton('elements', function ($app) {
            return new Elements;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['elements'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__ . '/../config/elements.php' => config_path('elements.php'),
        ], 'elements.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/jkl'),
        ], 'elements.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/jkl'),
        ], 'elements.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/jkl'),
        ], 'elements.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
