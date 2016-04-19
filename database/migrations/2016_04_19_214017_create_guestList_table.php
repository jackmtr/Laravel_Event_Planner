<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGuestListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guestList', function (Blueprint $table) {
            $table->increments('guestListId');
            $table->integer('contactID')->unsigned();
            $table->integer('eventId')->unsigned();
            $table->boolean('checkIn');
            $table->integer('status');
            $table->integer('invitedId')->unique();
            $table->integer('checkerId')->unique();

            $table->foreign('eventId')->references('eventId')->on('events');
            $table->foreign('contactID')->references('contactID')->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('guestList');
    }
}
