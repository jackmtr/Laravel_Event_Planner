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
            $table->increments('contact_id');
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('occupation')->nullable();
            $table->string('company')->nullable();
            $table->string('wechat_id')->nullable();
            $table->longtext('notes')->nullable();
            $table->integer('guest_of_id')->nullable();
            $table->integer('added_by')->unsigned();
            $table->softDeletes();
            $table->foreign('added_by')->references('user_id')->on('users');
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
