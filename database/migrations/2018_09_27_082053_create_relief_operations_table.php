<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReliefOperationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relief_operations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('donor')->nullable();
            $table->integer('dest_center_id')->unsigned();
            $table->foreign('dest_center_id')->references('id')->on('centers');
            $table->enum('confirmation', ['En Route', 'Arrived']);
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
        Schema::dropIfExists('relief_operations');
    }
}
