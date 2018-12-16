<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSenderColumnToReliefOperations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('relief_operations', function (Blueprint $table) {
            $table->integer('sender_id')->nullable()->unsigned()->after('donor');
            $table->foreign('sender_id')->references('id')->on('centers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('relief_operations', function (Blueprint $table) {
            //
        });
    }
}
