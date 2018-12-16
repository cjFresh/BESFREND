<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAidWorkerAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_worker_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aid_worker_id')->unsigned();
            $table->foreign('aid_worker_id')->references('id')->on('aid_workers');
            $table->integer('center_id')->unsigned()->nullable(); //if wala, wa pa ma assigned
            $table->foreign('center_id')->references('id')->on('centers');
            $table->enum('status', ['Present', 'Transferred', 'En Route', 'Last Post']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aid_worker_assignments');
    }
}
