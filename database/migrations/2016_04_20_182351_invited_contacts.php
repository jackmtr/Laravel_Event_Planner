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

        }
            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::drop('guestlists');
            }

}
