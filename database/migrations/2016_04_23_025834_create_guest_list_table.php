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
    Schema::drop('event_table_seats');
    Schema::drop('guestlists');
    Schema::create('guest_lists', function (Blueprint $table) {
      $table->increments('guest_list_id');
      $table->integer('additional_guests');
      $table->boolean('rsvp');
      $table->integer('checked_in_by')->nullable()->unsigned();
      $table->integer('contact_id')->unsigned();
      $table->integer('event_id')->unsigned();
      $table->timestamps();
      // foreign keys references
      $table->foreign('checked_in_by')->references('user_id')->on('users');
      $table->foreign('contact_id')->references('contact_id')->on('contacts');
      $table->foreign('event_id')->references('event_id')->on('events');
    });
    Schema::create('event_table_seats', function (Blueprint $table) {
      $table->increments('table_seating_id');
      $table->integer('table_number');
      $table->integer('seat_number');
      $table->integer('guest_list_id')->unsigned();
      $table->timestamps();

      $table->foreign('guest_list_id')->references('guest_list_id')->on('guest_lists')->nullable();
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
    Schema::drop('guest_lists');
    Schema::create('guestlists', function (Blueprint $table) {
      $table->increments('guest_list_id');
      $table->integer('additional_guests');
      $table->boolean('rsvp');
      $table->integer('checked_in_by')->nullable()->unsigned();
      $table->integer('contact_id')->unsigned();
      $table->integer('event_id')->unsigned();
      $table->timestamps();
      // foreign keys references
      $table->foreign('checked_in_by')->references('user_id')->on('users');
      $table->foreign('contact_id')->references('contact_id')->on('contacts');
      $table->foreign('event_id')->references('event_id')->on('events');
    });
    Schema::create('event_table_seats', function (Blueprint $table) {
      $table->increments('table_seating_id');
      $table->integer('table_number');
      $table->integer('seat_number');
      $table->integer('guest_list_id')->unsigned();
      $table->timestamps();

      $table->foreign('guest_list_id')->references('guest_list_id')->on('guestlists')->nullable();
    });
  }
}
