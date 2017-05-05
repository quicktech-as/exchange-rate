<?php

namespace Quicktech\ExchangeRate;

use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;

/**
 * This file is part of Quicktech\ExchangeRate package,
 * a wrapper solution for Laravel to Exchange Rate API.
 *
 * @license MIT
 * @package Quicktech\ExchangeRate
 */
class ExchangeRateServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/config.php' => app()->basePath() . '/config/exchange_rate.php',
        ]);

        $this->mergeConfig();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerExchangeRate();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerExchangeRate()
    {
        $this->app->bind('exchange_rate', function ($app) {
            $httpClient = new Client([
                'base_uri' => $app['config']->get('exchange_rate.api_uri')
            ]);

            return new ExchangeRateManager(
                $app->config->get('exchange_rate', []),
                $httpClient
            );
        });
    }

    /**
     * Merges user's and cargonizer's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'exchange_rate'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['exchange_rate'];
    }
}
