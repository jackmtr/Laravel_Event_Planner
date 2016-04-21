<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(range(1,100)as $index){

            $faker = Faker::create();
            $fakeFirstName = $faker->firstName($gender=null);
            $fakeLastName = $faker->lastName($gender=null);
            $fakeEmail = $faker->email;
            $fakeCompany = $faker->company;
            $fakeNotes = $faker->realText($maxNbChars = 50, $indexSize = 2);
            $fakeWichat = $faker->email;
            $fakeAddedBy = $faker->numberBetween(1,2);


            DB::table('contacts')->insert([
                'fname'=> $fakeFirstName,
                'lname'=>$fakeLastName,
                'email'=>$fakeEmail,
                'company' => $fakeCompany,
                'notes' => $fakeNotes,
                'wichat' => $fakeWichat,
                'occupation' => $fakeCompany,
                'addedBy' => $fakeAddedBy,
            ]);

        }
    }
}
