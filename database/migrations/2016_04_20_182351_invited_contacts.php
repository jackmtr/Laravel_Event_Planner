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
            Schema::create('guestLists', function (Blueprint $table) {
                $table->increments('guestListid');
                $table->integer('additionalGuests');
                $table->boolean('rsvp');
                $table->integer('checkedInBy')->unsigned()->nullable();
                $table->integer('contactId')->unsigned();
                $table->integer('eventId')->unsigned();
                $table->timestamps();
                // foreign keys references
                $table->foreign('checkedInBy')->references('userid')->on('users');
                $table->foreign('contactId')->references('contactId')->on('contacts');
                $table->foreign('eventId')->references('eventId')->on('events');
            });

        }
            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::drop('guestLists');
            }

}
