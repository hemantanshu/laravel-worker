<?php

namespace Hemantanshu\LaravelWorker\Controllers;

use App\Http\Controllers\Controller;
use Hemantanshu\LaravelWorker\Models\WorkerServer;

class WorkerServerController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index () {
        return WorkerServer::get();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show ($id) {
        return WorkerServer::find($id);
    }
}
