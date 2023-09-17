<?php

namespace Mobiverse\LaravelPami;

use Illuminate\Support\Facades\Log;
use PAMI\Message\Event\EventMessage;

/**
 * @package Mobiverse\LaravelPami
 * Example Event Handler class
 */
class ExampleEventMessageHandler implements IPamiEventMessageHandler
{
    public function execute(EventMessage $event): void
    {
        dump($event->getName());
        Log::debug($event->getName());
    }
}
