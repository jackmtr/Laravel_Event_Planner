<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function(Blueprint $table){
            $table->increments('contactId');
            $table->string('fname');
            $table->string('lname');
            $table->string('email')->unique();
            $table->string('occupation');
            $table->string('company');
            $table->string('wichat');
            $table->longtext('notes');
            $table->integer('addedBy')->unsigned();
            $table->timestamps();
            $table->foreign('addedBy')->references('userId')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contacts');
    }
}
