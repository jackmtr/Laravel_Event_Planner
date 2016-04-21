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
            $table->increments('eventid');
            $table->string('eventName');
            $table->date('date');
            $table->datetime('time');
            $table->string('location');
            $table->longtext('description');
            $table->integer('numOfTables');
            $table->integer('seatsPerTable');
            $table->integer('eventStatus');
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
        Schema::drop('events');
    }
}
