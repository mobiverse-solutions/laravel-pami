<?php

namespace Mobiverse\LaravelPami;

use Exception;
use Mobiverse\LaravelPami\Jobs\ProcessEvent;
use PAMI\Client\Impl\ClientImpl;
use PAMI\Listener\IEventListener;
use PAMI\Message\Event\EventMessage;

/**
 * @package Mobiverse\LaravelPami
 * Event Listener Class
 */
class PamiEventMessageListener implements IEventListener
{
    private ClientImpl $client;

    private bool $keepAlive = false;

    private array $subscriptions = [];

    public function __construct()
    {
        $pamiOptions = config('laravel-pami.asterisk_ami');
        $this->client = new ClientImpl($pamiOptions);
        $this->client->registerEventListener($this);
        $this->keepAlive = true;

        $event_subscriptions = config('laravel-pami.subscriptions');
        foreach ($event_subscriptions as $event => $handlers) {
            $hands = [];
            foreach ($handlers as $handler) {
                if (!class_exists($handler)) {
                    throw new Exception("Class $handler not found");
                }
                if (!is_subclass_of($handler, IPamiEventMessageHandler::class)) {
                    throw new Exception("Class $handler must implement IPamiEventHandler");
                }
                $hands[] = new $handler();
            }
            $this->subscribe($event, $hands);
        }
    }

    private function subscribe(string $event, array $eventHandlers): void
    {
        $this->subscriptions[$event] = $eventHandlers;
    }

    public function handle(EventMessage $event): void
    {
        $handlers = $this->subscriptions[$event->getName()] ?? [];
        foreach ($handlers as $handler) {
//            ProcessEvent::dispatch($handler, $event);
            switch($pid = pcntl_fork())
            {
                case 0:
                    $handler->execute($event);
                    echo "Application finished\n";
                    exit(0);
                    break;
                case -1:
                    echo "Could not fork application\n";
                    break;
                default:
                    echo "Forked Application\n";
                    break;
            }
        }
    }

    public function run()
    {
        pcntl_signal(SIGTERM, fn ($signo) => $this->sigHandler($signo));
        pcntl_signal(SIGINT, fn ($signo) => $this->sigHandler($signo));
        pcntl_signal(SIGHUP, fn ($signo) => $this->sigHandler($signo));

        $this->client->open();
        while ($this->keepAlive) {
            usleep(1000);
            $this->client->process();
        }
        $this->client->close();

        pcntl_signal_dispatch();
    }

    private function sigHandler($signo): void
    {
        switch ($signo) {
            case SIGINT:
            case SIGTERM: // Supervisor sends this signal to stop the loop
                $this->keepAlive = false; // Set the condition to false to exit the loop
                break;
            case SIGHUP: // Supervisor sends this signal to restart the loop
// Do any cleanup or initialization tasks here
                break;
            default:
// Handle other signals here
        }
    }
}
