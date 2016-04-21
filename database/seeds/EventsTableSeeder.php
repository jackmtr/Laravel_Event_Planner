<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        foreach(range(1,10)as $index){

            $faker = Faker::create();
            $fakeName = $faker->country;
            $fakeStatus = $faker->randomNumber($nbDigits = 1);
            $fakeEventTime = $faker->time($format = 'H:i:s', $max = 'now');
            $fakeEventDate = $faker->date($format = 'Y-m-d', $max = 'now');
            $fakeLocation = $faker->address;
            $fakeNumTables = $faker->randomDigitNotNull;
            $fakeNumSeats = $faker->randomDigitNotNull;


            DB::table('events')->insert([
                'eventName'=> $fakeName,
                'event_status'=>$fakeStatus,
                'eventTime'=>$fakeEventTime,
                'eventDate' => $fakeEventDate,
                'location' => $fakeLocation,
                'number_of_tables' => $fakeNumTables,
                'number_of_seats' => $fakeNumSeats,

            ]);

        }
    }
}
