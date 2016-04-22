<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
    	'eventName',
    	'date',
    	'time',
    	'location',
    	'description',
    	'numOfTable',
    	'seatsPerTable',
    	'eventStatus',
    ];

    public $timestamps = false;
}
