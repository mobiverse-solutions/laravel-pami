<?php

return [
    'asterisk_ami' => [
        'username' => env('LARAVEL_PAMI_USERNAME', 'clickmobileNode'),
        'host' => env('LARAVEL_PAMI_HOST', '10.8.0.50'),
        'port' => env('LARAVEL_PAMI_PORT', '5038'),
        'secret' => env('LARAVEL_PAMI_SECRET', 'bfdfa25eb7f8a04406572dec91d2a98b'),
        'connect_timeout' => env('LARAVEL_PAMI_CONNECT_TIMEOUT', 5),
        'read_timeout' => env('LARAVEL_PAMI_READ_TIMEOUT', 5),
        'scheme' => env('LARAVEL_PAMI_SCHEME', 'tcp://') // try tls://
    ],

    'subscriptions' => [
        'ExtensionStatus' => [
            \Mobiverse\LaravelPami\ExampleEventMessageHandler::class,
        ]
    ],

    'queue_name' => env('LARAVEL_PAMI_QUEUE_NAME', 'default'),
];
