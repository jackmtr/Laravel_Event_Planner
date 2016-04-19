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
        Schema::create('contacts', function (Blueprint $table) {
            $table->increments('contactId');
            $table->timestamps();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->string('phoneNumber');
            $table->string('notes')->nullable();
            $table->string('watchItId')->nullable();

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
