<?php

namespace Hemantanshu\LaravelWorker;

use Illuminate\Support\ServiceProvider;

class LaravelWorkerServiceProvider extends ServiceProvider {
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot () {
        $this->publishes([
            __DIR__ . '/Migrations' => database_path('migrations'),
        ], 'migrations');
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register () {
        $this->app->bind('laravelWorker', LaravelWorker::class);
    }
}
