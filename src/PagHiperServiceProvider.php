<?php

namespace Flromano\LaravelPagHiper;

use Illuminate\Support\ServiceProvider;

class PagHiperServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('flromano.paghiper', function ($app) {
            return $app->make(PagHiper::class);
        });

        $this->publishes([
            __DIR__.'/config/paghiper.php' => config_path('paghiper.php'),
        ], 'config');

        $this->mergeConfigFrom(
        __DIR__.'/config/paghiper.php',
            'paghiper'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['flromano.paghiper'];
    }
}
