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
        DB::table('contacts')->delete();

        foreach(range(1,100)as $index){

            $faker = Faker::create();
            $fakeFirstName = $faker->firstName($gender=null);
            $fakeLastName = $faker->lastName($gender=null);
            $fakeEmail = $faker->email;
            $fakeCompany = $faker->company;
            $fakeWichat = $faker->email;
            $fakeAddedBy = $faker->numberBetween(1,2);

            DB::table('contacts')->insert([
                'first_name'=> $fakeFirstName,
                'last_name'=>$fakeLastName,
                'email'=>$fakeEmail,
                'company' => $fakeCompany,
                'wechat_id' => $fakeWichat,
                'occupation' => $fakeCompany,
                'added_by' => $fakeAddedBy,
            ]);
        }
    }
}
