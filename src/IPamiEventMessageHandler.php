<?php

namespace Mobiverse\LaravelPami;

use PAMI\Message\Event\EventMessage;

/**
 * @package Mobiverse\LaravelPami
 * Event handler interface
 */
interface IPamiEventMessageHandler
{
    public function execute(EventMessage $event): void;
}
