<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
  use SoftDeletes;

  protected $primaryKey = 'event_id';

  protected $fillable = [
    'event_name',
    'event_date',
    'event_time',
    'event_end_time',
    'event_location',
    'event_description',
    'event_status',    
    //'num_of_tables',
    //'seats_per_table',
  ];
  protected $dates = ["deleted_at"];

  public $timestamps = false;

  /**
  * An event may have many guests.
  *
  * @return \Illuminate\Database\Eloquent\Relations\HasMany
  */
  public function guestList(){
    return $this->hasMany('App\GuestList');
  }
}
