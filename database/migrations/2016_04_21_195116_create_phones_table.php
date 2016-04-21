<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('phoneNumbers', function (Blueprint $table) {
            $table->increments('phoneNumberId');
            $table->string('phoneNumber');
            $table->integer('contactId')->unsigned();
            $table->timestamps();
            $table->foreign('contactId')->references('contactId')->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('phoneNumbers');


    }
}
