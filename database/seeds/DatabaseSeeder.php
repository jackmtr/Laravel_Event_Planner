<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      //  $this->call(ContactsTableSeeder::class);
      //  $this->call(EventsTableSeeder::class);
        $contacts       =  DB::table('contacts');
        $events         =  DB::table('events');
        $users          =  DB::table('users');
        $invitedContacts=  DB::table('invitedContacts');
        $eventTableSeats=  DB::table('eventTableSeats');

        $faker = Faker::create();
        $populator = new \Faker\ORM\Propel\Populator($faker);
        $populator->addEntity($contacts, 100);
        $populator->addEntity($events,   10);
        $populator->addEntity($users, 5);
        $populator->addEntity($invitedContacts, 30);
        $populator->addEntity($eventTableSeats, 25);
        $insertedPKs = $populator->execute();
    }
}
