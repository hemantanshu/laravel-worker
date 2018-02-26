<?php

namespace Hemantanshu\LaravelWorker;

/**
 * Class LaravelWorker
 * @package Hemantanshu\LaravelWorker
 */
class LaravelWorker {

    /**
     * @var null
     */
    public static $queue_url = null;

    /**
     *
     */
    public static function getQueueUrl () {
        if ( !self::$queue_url )
            self::$queue_url = config('queue.connections.sqs.prefix') . '/' . config('queue.connections.sqs.queue');
    }

    public static function getNextJob () {
        
    }
}