<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventWithCount extends Model
{
   protected $event;
   protected $count;

   public function __construct($event, $count) {
       $this->event = $event;
       $this->count = $count;
   }
}
