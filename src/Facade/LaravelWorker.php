<?php

namespace Hemantanshu\LaravelWorker\Facade;

use Illuminate\Support\Facades\Facade;

class LaravelWorker extends Facade {
    protected static function getFacadeAccessor () {
        return 'laravelWorker';
    }
}