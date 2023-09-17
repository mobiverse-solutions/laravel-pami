<?php

namespace Mobiverse\LaravelPami\Tests\Unit;

use Illuminate\Support\Facades\Config;

test('confirm environment is set to testing', function () {
    expect(config('app.env'))->toBe('testing');
});

test('console command', function () {
    Config::set('laravel-pami.asterisk_ami.connect_timeout', 5);
    Config::set('laravel-pami.asterisk_ami.read_timeout', 5);
    Config::set('laravel-pami.asterisk_ami.username', 'clickmobileNode');
    Config::set('laravel-pami.asterisk_ami.secret', 'bfdfa25eb7f8a04406572dec91d2a98b');
    Config::set('laravel-pami.asterisk_ami.host', '10.8.0.50');
    Config::set('laravel-pami.asterisk_ami.port', '5038');
    Config::set('laravel-pami.asterisk_ami.scheme', 'tcp://');
    Config::set('laravel-pami.subscriptions', [
        'ExtensionStatus' => [
            \Mobiverse\LaravelPami\ExampleEventMessageHandler::class,
        ]
    ]);
    $this->artisan('pami:start')->assertExitCode(0);
});