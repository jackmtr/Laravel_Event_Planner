<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class Event extends Model
{
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

  protected $dates = ["event_date"]; //lets event_date be a carbon item

  protected $times = ["event_time"]; // we need to migrate db to change event_time from datetime to time

  public $timestamps = false;//will not use timestamps, we might change this later

  public function setEventStatusAttribute($value){
    $this->attributes['event_status'] = 0;
  }
}
