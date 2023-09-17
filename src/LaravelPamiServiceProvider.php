<?php

namespace Mobiverse\LaravelPami;

use Illuminate\Support\ServiceProvider;

/**
 * @package Mobiverse\LaravelPami
 * Laravel Asterisk ARI service provider class
 */
class LaravelPamiServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes(
            [
            __DIR__ . '/../config/laravel-pami.php' => config_path('laravel-pami.php'),
            ],
            'laravel-pami-config'
        );

        $this->registerCommands();
    }

    /**
     * Register the package commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        $this->commands(
            [
                Console\Commands\StartServer::class,
            ]
        );
    }
}
