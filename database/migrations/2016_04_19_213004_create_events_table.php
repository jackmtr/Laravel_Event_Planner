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
            $table->date('event_date')->nullable();
            $table->time('event_time')->nullable();
            $table->time('event_end_time')->nullable();
            $table->string('event_location')->nullable();
            $table->longtext('event_description')->nullable();
            $table->integer('num_of_tables')->nullable();
            $table->integer('seats_per_table')->nullable();
            $table->integer('event_status')->default(0);
            $table->softDeletes();
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
