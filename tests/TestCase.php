<?php

namespace Mobiverse\LaravelPami\Tests;

use Mobiverse\LaravelPami\LaravelPamiServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

/**
 * @package Mobiverse\LaravelPami
 * Class TestCase
 */
class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [
            LaravelPamiServiceProvider::class,
        ];
    }
}
