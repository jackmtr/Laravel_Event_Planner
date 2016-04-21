<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('eventId');
            $table->string('eventName');
            $table->integer('event_status');
            $table->string('confirmedGuests')->nullable();
            $table->dateTime('eventTime')->nullable();
            $table->date('eventDate')->nullable();
            $table->string('location')->nullable();
            $table->integer('number_of_tables')->nullable();
            $table->integer('number_of_seats')->nullable();




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('events');
    }
}
