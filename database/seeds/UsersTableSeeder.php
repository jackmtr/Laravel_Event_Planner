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
        //

        foreach(range(1,5)as $index){

            $faker = Faker::create();
          //  $fakeUserid = $faker->;
          //  $fakeContactId = $faker->;
            $fakeEmail = $faker->email;
            $fakeName = $faker->firstName($gender=null);
            $fakePassword = $faker->password;


            DB::table('users')->insert([
               // 'userid'=> $fakeUserid,
              //  'contactId'=>$fakeContactId,
                'email'=>$fakeEmail,
                'name' => $fakeName,
                'password' => $fakePassword,

            ]);



        }
    }
}
