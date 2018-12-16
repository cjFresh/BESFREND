<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyToHouseholdEvacs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('household_evacs', function (Blueprint $table) {
            $table->integer('evacuation_id')->unsigned()->after('center_id');
            $table->foreign('evacuation_id')->references('id')->on('evacuations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('household_evacs', function (Blueprint $table) {
            $table->dropForeign('evacuation_id');
        });
    }
}
