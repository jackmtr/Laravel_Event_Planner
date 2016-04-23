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
    Schema::create('event_table_seats', function (Blueprint $table) {
      $table->increments('table_seating_id');
      $table->integer('table_number');
      $table->integer('seat_number');
      $table->integer('guest_list_id')->unsigned();
      $table->timestamps();

      $table->foreign('guest_list_id')->references('guest_list_id')->on('guestlists')->nullable();
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::drop('event_table_seats');
  }
}
