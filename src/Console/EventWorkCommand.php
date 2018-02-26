<?php

namespace Hemantanshu\LaravelWorker\Console;

use Illuminate\Console\Command;

class EventWorkCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:work';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process job from queue';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct () {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle () {
        //
    }
}
