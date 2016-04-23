<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\GuestList;

class EventWithCount extends Model
{
   protected $event_id;
   protected $event_name;
   protected $event_time;
   protected $event_date;
   protected $event_location;
   protected $event_description;
   protected $num_of_tables;
   protected $seats_per_table;
   protected $event_status;
   protected $count;

   public function __construct($event) {
       $this->event_id = $event->event_id;
       $this->event_name = $event->event_name;
       $this->event_time = $event->event_time;
       $this->event_date = $event->event_date;
       $this->event_location = $event->event_location;
       $this->event_description = $event->description;
       $this->num_of_tables = $event->num_of_tables;
       $this->seats_per_table = $event->seats_per_table;
       $this->event_status = $event->event_status;
       if($event->event_status == 0){
         $this->count = GuestList::where('event_id', '=', $event->event_id)->count();
       } else {
         $this->count = GuestList::where('event_id', '=', $event->event_id)->whereNotNull('checked_in_by')->count();
       }
   }
}
