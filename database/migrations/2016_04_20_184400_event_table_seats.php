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
            $table->increments('eventTableSeatId');
            $table->timestamps();
            $table->integer('tableNum');
            $table->integer('seatNum');
            $table->boolean('checkIn');
            $table->integer('eventId')->unsigned();
            $table->integer('invited_contact_id')->unsigned();
            $table->integer('userid')->unsigned();



            $table->foreign('invited_contact_id')->references('invited_contact_id')->on('invitedContacts');
            $table->foreign('eventId')->references('eventId')->on('events');
            $table->foreign('userId')->references('userId')->on('users');
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
