<?php

namespace Hemantanshu\LaravelWorker\Models;

use Illuminate\Database\Eloquent\Model;

class WorkerProcess extends Model {
    protected $table = 'event_worker_processes';

    protected $guarded = ['created_at', 'updated_at'];

    public function scopeActive ($query) {
        $query->where('active', true);
    }
}
