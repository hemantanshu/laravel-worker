<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventWorkerProcessesTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('event_worker_processes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('server_hostname');
            $table->integer('pid');
            $table->string('job_name');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('event_worker_processes');
    }
}
