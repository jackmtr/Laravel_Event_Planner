<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestTableSeatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guestTableSeating', function (Blueprint $table) {

            $table->integer('guestListId')->unsigned();
            $table->integer('tableNumber');
            $table->integer('seatNumber');
            $table->increments('tableSeatId');


            $table->foreign('guestListId')->references('guestListId')->on('guestList');
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

            //
            Schema::drop('guestTableSeating');

    }
}
