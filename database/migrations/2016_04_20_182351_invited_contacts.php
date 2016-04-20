<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InvitedContacts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitedContacts', function (Blueprint $table) {
            $table->increments('invited_contact_id')->unique();
            $table->timestamps();
            $table->integer('status_rsvp');
            $table->integer('number_of_guests');
            $table->integer('contactId')->unsigned();
            $table->integer('userId')->unsigned();


            $table->foreign('contactId')->references('contactId')->on('contacts');
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
        Schema::drop('invitedContacts');
    }
}
