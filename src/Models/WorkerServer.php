<?php

namespace Hemantanshu\LaravelWorker\Models;

use Illuminate\Database\Eloquent\Model;

class WorkerServer extends Model {
    protected $table = 'event_worker_servers';

    protected $guarded = ['created_at', 'updated_at'];
}
