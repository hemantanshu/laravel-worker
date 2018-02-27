<?php

namespace Hemantanshu\LaravelWorker;

use Hemantanshu\LaravelWorker\Models\WorkerProcess;
use Hemantanshu\LaravelWorker\Models\WorkerServer;

/**
 * Class LaravelWorker
 * @package Hemantanshu\LaravelWorker
 */
class LaravelWorker {

    /**
     * Check if worker can process message on the given server
     * And also log the process against this worker
     * @return bool|mixed
     */
    public static function canExecuteJobOnServer () {
        $server = self::getServerDetails();

        //check if server is enabled
        if ( !$server ) return false;

        return self::logProcess();
    }

    /**
     * Update the record in process table against that given job
     * @param $job
     * @return mixed
     */
    public static function logJob ($job) {
        $process = self::logProcess();

        $process->job_name = $job;
        $process->processed += 1;
        $process->save();

        return $process;
    }

    /**
     * Get the active server
     * @return bool
     */
    private static function getServerDetails () {
        $server = WorkerServer::firstOrCreate([
            'server_hostname' => gethostname(),
        ]);

        if ( isset($server->active) && !$server->active )
            return false;

        return $server;
    }

    /**
     * Get the current active process being executed by the worker
     * @return mixed
     */
    public static function logProcess () {
        $process = WorkerProcess::firstOrCreate([
            'server_hostname' => gethostname(),
            'pid'             => getmypid(),
        ]);

        return $process;
    }
}