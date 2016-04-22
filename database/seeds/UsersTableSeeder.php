<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        
        DB::table('users')->insert([
            'user_id'=> 1,
            'email'=>'admin@email.com',
            'name' => 'Admin',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'user_id'=> 2,
            'email'=>'admin2@email.com',
            'name' => 'Admin2',
            'password' => bcrypt('password2'),
        ]);
    }
}
