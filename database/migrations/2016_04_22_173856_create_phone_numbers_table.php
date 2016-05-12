<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('phone_numbers', function (Blueprint $table) {
             $table->increments('phone_number_id');
             $table->string('phone_number');
             $table->integer('contact_id')->unsigned();
             $table->softDeletes();
             $table->foreign('contact_id')->references('contact_id')->on('contacts');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::drop('phone_numbers');
     }
 }
