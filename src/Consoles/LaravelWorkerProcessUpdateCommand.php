<?php

namespace Hemantanshu\LaravelWorker\Consoles;

use Hemantanshu\LaravelWorker\LaravelWorker;
use Illuminate\Console\Command;

class LaravelWorkerProcessUpdateCommand extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:process-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command would update the inactive process from the system';

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
        LaravelWorker::invalidateInactiveProcesses();
    }
}
