<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeletedAt extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts', function($table){
            $table->softDeletes();
        });

        Schema::table('events', function($table){
            $table->softDeletes();
        });

        Schema::table('guest_lists', function($table){
            $table->softDeletes();
        });                

        Schema::table('phone_numbers', function($table){
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('phone_numbers', function($table){
            $table->dropSoftDeletes();
        });

        Schema::table('guest_lists', function($table){
            $table->dropSoftDeletes();
        });        
           
        Schema::table('contacts', function($table){
            $table->dropSoftDeletes();
        }); 

        Schema::table('events', function($table){
            $table->dropSoftDeletes();
        }); 
    }
}
