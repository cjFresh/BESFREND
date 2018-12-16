<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHouseholdEvacsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('household_evacs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('household_member_id')->unsigned();
            $table->foreign('household_member_id')->references('id')->on('household_members');
            $table->integer('center_id')->unsigned()->nullable();
            $table->foreign('center_id')->references('id')->on('centers');
            $table->enum('whereabouts', ['Found', 'Missing']);
            $table->enum('status', ['Fine', 'Injured/Sick', 'Deceased', 'Unknown']);
            $table->text('remarks');
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
        Schema::dropIfExists('household_evacs');
    }
}
