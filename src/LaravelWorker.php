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
     * @var null
     */
    private static $hostname = null;

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
     * Check for active processes on the server and mark all inactive process
     * logged
     */
    public static function invalidateInactiveProcesses () {
        $activePIDs = self::loadActiveProcesses();
        $workers = WorkerProcess::active()->where('server_hostname', self::getSystemActiveIdentifier())->get();

        foreach ( $workers as $worker ) {
            if ( in_array($worker->pid, $activePIDs) )
                continue;

            $worker->active = false;
            $worker->save();
        }
    }

    /**
     * Get the active server
     * @return bool
     */
    private static function getServerDetails () {
        $server = WorkerServer::firstOrCreate([
            'server_hostname' => self::getSystemActiveIdentifier(),
        ]);

        if ( isset($server->active) && !$server->active )
            return false;

        return $server;
    }

    /**
     * Get the current active process being executed by the worker
     * @return mixed
     */
    private static function logProcess () {
        $process = WorkerProcess::firstOrCreate([
            'server_hostname' => self::getSystemActiveIdentifier(),
            'pid'             => getmypid(),
        ]);

        return $process;
    }

    /**
     * @return null|string
     */
    private static function getSystemActiveIdentifier () {
        if ( !self::$hostname ) {
            $machineId = trim(shell_exec('cat /etc/machine-id 2>/dev/null'));
            self::$hostname = $machineId . '-' . gethostname();
        }

        return self::$hostname;
    }

    /**
     * Get the processes that are active in the system and run through php
     * @return array
     */
    private static function loadActiveProcesses () {
        $processes = shell_exec('ps -e | grep php');
        $activeProcesses = [];
        foreach ( preg_split("/((\r?\n)|(\r\n?))/", $processes) as $process ) {
            array_push($activeProcesses, self::extractPID($process));
        }

        return $activeProcesses;
    }

    /**
     * Get the pid no from the extract
     * @param $process
     * @return mixed
     */
    private static function extractPID ($process) {
        $processIds = explode(' ', $process);
        foreach ( $processIds as $pid ) {
            if ( $pid && is_numeric($pid) )
                return $pid;
        }
    }
}