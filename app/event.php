<?php

namespace App;

use Illuminate\Database\Eloquent\Model as Model;

class Event extends Model
{
    protected $fillable = [
    	'event_name',
    	'event_date',
		'event_time',
		'event_location',
		'event_description',
		'num_of_tables',
		'seats_per_table',
    ];

    public $timestamps = false;
}
