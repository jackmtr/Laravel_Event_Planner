<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
  use SoftDeletes;

  protected $primaryKey = 'event_id'; //tells laravel what our primary key is

  protected $fillable = [
    'event_name',
    'event_date',
    'event_time',
    'event_location',
    'event_description',
    'num_of_tables',
    'seats_per_table',
    'event_status',
  ];//allows these columns to be changed, and will ignore requests to change any other column
    //INSERT INTO events (event_name, event_date, event_time, event_location, event_description, num_of_tables, seats_per_table, event_status) VALUES ('Canada Day 2015', '2015-06-03', '', '555 Saymour street','over 1 million people are watching on TV',5,8,2);
    
  //eventually set a query scope to most closest to Carbon::now()

  protected $dates = ["event_date", "deleted_at"]; //lets event_date be a carbon item

  protected $times = ["event_time"]; //we need to migrate db to change event_time from datetime to time

  public $timestamps = false;//will not use timestamps, we might change this later

  public function setEventStatusAttribute($value){
    $this->attributes['event_status'] = 0;
  }//used to force set event creation's event status to open mode

  //date needs a mutator so edit form model can be set

  //time needs a mutator so edit form model can be set
  /**
  * An event may have many guests.
  *
  * @return \Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function guestList(){
    return $this->hasMany('App\GuestList');
  }
}
