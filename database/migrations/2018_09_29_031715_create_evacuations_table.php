<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvacuationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evacuations', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('emergency', ['Fire', 'Typhoon', 'Non-Typhoon Flooding', 'Tsunami', 'Earthquake', 'Volcanic Activity', 'Landslide', 'Mass Violence', 'Outbreak']);
            $table->text('remarks')->nullable();
            $table->integer('brgy_id')->unsigned();
            $table->foreign('brgy_id')->references('id')->on('barangays');
            $table->enum('status', ['Ongoing', 'Done']);
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
        Schema::dropIfExists('evacuations');
    }
}
