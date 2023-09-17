<?php

namespace Mobiverse\LaravelPami\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mobiverse\LaravelPami\IPamiEventMessageHandler;
use PAMI\Message\Event\EventMessage;

/**
 * @package Mobiverse\LaravelPami
 * Event handler Job
 */
class ProcessEventMessage implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public IPamiEventMessageHandler $eventHandler;

    public EventMessage $event;

    /**
     * Create a new job instance.
     */
    public function __construct(
        IPamiEventMessageHandler $eventHandler,
        EventMessage $event
    ) {
        $this->onQueue(config('laravel-pami.queue_name', 'default'));
        $this->event = $event;
        $this->eventHandler = $eventHandler;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->eventHandler->execute($this->event);
    }
}
