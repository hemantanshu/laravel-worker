<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventWorkerServersTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up () {
        Schema::create('event_worker_servers', function (Blueprint $table) {
            $table->increments('id');

            $table->string('server_hostname')->unique();
            $table->boolean('active')->default(true);
            $table->integer('maximum_processes')->default(0);

            $table->timestamps();

            $table->index('server_hostname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down () {
        Schema::dropIfExists('event_worker_servers');
    }
}
