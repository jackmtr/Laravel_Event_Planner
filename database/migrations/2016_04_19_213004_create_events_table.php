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
        Schema::create('events', function (Blueprint $table){
            $table->increments('event_id');
            $table->string('event_name');
            $table->date('event_date');
            $table->time('event_time');
            $table->string('event_location');
            $table->longtext('event_description');
            $table->integer('num_of_tables');
            $table->integer('seats_per_table');
            $table->integer('event_status');
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
