<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Event;
use App\GuestList;

class EventDetails extends Model
{
  protected $event_id;
  protected $event_name;
  protected $event_status;
  protected $guestList;
  protected $rsvpYes;
  protected $checkedIn;

  public function __construct($event_id) {
    $event = Event::find($event_id);
    $this->event_id = $event->event_id;
    $this->event_name = $event->event_name;
    $this->event_status = $event->event_status;
    $this->guestList = GuestList::where('event_id', '=', $event_id);
    $this->rsvpYes = $this->guestList->where('rsvp')->count();
    $this->checkedIn = $this->guestList->whereNotNull('checked_in_by')->count();
  }
}
