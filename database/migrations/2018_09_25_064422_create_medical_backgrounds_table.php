<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_backgrounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('household_member_id')->unsigned();
            $table->foreign('household_member_id')->references('id')->on('household_members');
            $table->string('condition');
            $table->enum('severity', ['Fully Recovered', 'Mild', 'Severe', 'Life-Threatening']);
            $table->text('medication')->nullable();
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
        Schema::dropIfExists('medical_backgrounds');
    }
}
