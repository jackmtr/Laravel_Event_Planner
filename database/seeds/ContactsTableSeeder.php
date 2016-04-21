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
            $fakePhoneNum = $faker->phoneNumber;
            $fakeCompany = $faker->company;
            $fakeNotes = $faker->realText($maxNbChars = 50, $indexSize = 2);
            $fakeWichatId = $faker->realText($maxNbChars = 50, $indexSize = 2);


            DB::table('contacts')->insert([
                'firstName'=> $fakeFirstName,
                'lastName'=>$fakeLastName,
                'email'=>$fakeEmail,
                'phoneNumber' => $fakePhoneNum,
                'company' => $fakeCompany,
                'notes' => $fakeNotes,
                'wichatId' => $fakeWichatId,

            ]);

        }
    }
}
