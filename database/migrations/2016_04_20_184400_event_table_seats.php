<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EventTableSeats extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

            Schema::create('eventTableSeats', function (Blueprint $table) {
                $table->increments('tableSeatingid');
                $table->integer('tableNum');
                $table->integer('seatNum');
                $table->integer('guestListId')->unsigned();
                $table->timestamps();

                $table->foreign('guestListId')->references('guestListId')->on('guestLists');
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('eventTableSeats');
    }
}
