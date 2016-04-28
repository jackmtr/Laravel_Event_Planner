<?php

namespace App\Http\Controllers;

use App\Event;
use App\GuestList;
use App\Contact;
use App\Http\Requests\EventRequest;
use App\Http\Requests;
use App\EventWithCount;
use App\EventDetails;
//use Carbon\Carbon;
//use Illuminate\Http\Request;
use Request;

class EventController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventsWithCount = array();

        foreach(Event::latest("event_status")->get() as $event){
          $eventWithCount = new EventWithCount($event);
          $eventsWithCount[] = $eventWithCount;
        }
        return view('eventFolder.events', compact('eventsWithCount'));
    }

    public function create()
    {
        return view('eventFolder.createEvents');
    }

    public function store(EventRequest $request){
        $request["event_status"] = 0;
        Event::create($request->all());
        return redirect('events');
    }

    public function show($id)
    {
      $guests = GuestList::where('event_id', '=', $id); //get event guestlist

      $event = Event::find($id); //get event details to pass to view
      $eventGuests = $guests->get();
      $guestList = array(); //guestList contact details to pass to view
      foreach( $eventGuests as $guest)
      {
        $oneGuest['rsvp'] = $guest->rsvp;
        $oneGuest['additional_guests'] = $guest->additional_guests;
        //add guest Notes

        $first_name = Contact::find($guest->contact_id)->first_name;
        $last_name = Contact::find($guest->contact_id)->last_name;
        $oneGuest['name'] = $first_name . " " . $last_name;

        $occupation = Contact::find($guest->contact_id)->occupation;
        $company = Contact::find($guest->contact_id)->company;
        $oneGuest['work'] = $occupation . " " . $company;
        $guestList[] = $oneGuest;
      }
      $rsvpYes = $guests->where('rsvp')->count(); //count of guestList rsvp yes to pass to view
      $checkedIn = $guests->whereNotNull('checked_in_by')->count(); //count of guestList already checked in to pass to view

      return view('eventFolder.eventsDetail', compact('event', 'guestList', 'rsvpYes','checkedIn'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('eventFolder.editEvents', compact("event"));
    }

    public function update(EventRequest $request, $id)
    {
        $event = Event::findOrFail($id)->update($request->all());
        return redirect('events');
    }
}
