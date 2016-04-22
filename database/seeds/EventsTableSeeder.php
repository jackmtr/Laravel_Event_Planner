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
        DB::table('events')->delete();

        foreach(range(1,10)as $index){

            $faker = Faker::create();
            $fakeName = $faker->country;
            $fakeEventTime = $faker->time($format = 'H:i:s', $max = 'now');
            $fakeEventDate = $faker->date($format = 'Y-m-d', $max = 'now');
            $fakeLocation = $faker->address;
            $fakeNumTables = $faker->randomDigitNotNull;
            $fakeNumSeats = $faker->randomDigitNotNull;

            DB::table('events')->insert([
                'event_name'=> $fakeName,
                'event_status'=>0,
                'event_time'=>$fakeEventTime,
                'event_date' => $fakeEventDate,
                'event_location' => $fakeLocation,
                'num_of_tables' => $fakeNumTables,
                'seats_per_table' => $fakeNumSeats,
            ]);
        }
    }
}
