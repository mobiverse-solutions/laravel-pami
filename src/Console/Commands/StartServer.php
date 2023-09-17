<?php

namespace Mobiverse\LaravelPami\Console\Commands;

use Illuminate\Console\Command;
use Mobiverse\LaravelPami\PamiEventMessageListener;

/**
 * @package Mobiverse\LaravelPami
 * Class StartServer
 */
class StartServer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pami:start';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start the PAMI Async service';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $listener = new PamiEventMessageListener();
        $listener->run();
    }
}
