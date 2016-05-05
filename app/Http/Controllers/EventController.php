<?php

namespace App\Http\Controllers;

use App\Event;
use App\GuestList;
use App\Http\Requests\EventRequest;
use App\EventWithCount;
use App\EventDetails;
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

        //if eventstatus 0, event->guestLists->count, else event->guestLists->where checkedInBy not null->count
        foreach(Event::latest("event_status")->get() as $event){
          $guests = $event->guestList()->get();
          if($event->event_status == 0){
            $count = count($guests); //invited
          } else {
            $count = count($guests->where('checked_in_by', null)); //going or went
          }      
          $eventWithCount = new EventWithCount($event, $count);
          $eventsWithCount[] = $eventWithCount;
        }
        return view('eventFolder.events', compact('eventsWithCount'));
    }

    public function create()
    {
        return view('eventFolder.createEvents');
    }

    public function store(EventRequest $request){

        $request["event_status"] = 0; //better way to do this?
        Event::create($request->all());
        return redirect('events');
    }

    public function show($id)
    {
      $events = Event::all();
      $event = Event::findOrFail($id); //get event details to pass to view   
      //used to invite previous guests from another event to this event.
      if(Request::input('events')){
        $previousGuestList = Event::findOrFail(Request::input('events'))->guestList()->get();

        foreach ($previousGuestList as $previousGuest) {
          if($previousGuest->contact['contact_id'] > 0){
            GuestList::create(['rsvp' => 0, 'checked_in_by' => null, 'contact_id' => $previousGuest->contact['contact_id'], 'event_id' => $event->event_id]);
          }
        }
      }      
      $guests = $event->guestList()->get();
      $guestList = array(); //guestList contact details to pass to view

      foreach( $guests as $guest)
      {
        $oneGuest['guest_list_id'] = $guest->guest_list_id;
        $oneGuest['rsvp'] = $guest->rsvp;
        $oneGuest['additional_guests'] = $guest->additional_guests;
        $oneGuest['note'] = "coming soon";
        $first_name = $guest->contact()->withTrashed()->first()->first_name;
        $last_name = $guest->contact()->withTrashed()->first()->last_name;
        $oneGuest['name'] = $first_name . " " . $last_name;

        $occupation = $guest->contact()->withTrashed()->first()->occupation;
        $company = $guest->contact()->withTrashed()->first()->company;
        $oneGuest['work'] = $occupation . " " . $company;
        $oneGuest['contact'] = $guest->contact()->first();
        //dd($oneGuest['contact']);

        $guestList[] = $oneGuest;
      }

      $rsvpYes = count($guests->where('rsvp', 1)); //count of guestList rsvp yes to pass to view
      $checkedIn = count($guests->where('checked_in_by', null)); //count of guestList already checked in to pass to view
      $index = 0;

      return view('eventFolder.eventsDetail', compact('events', 'event', 'guestList', 'rsvpYes','checkedIn','index'));
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

    public function destroy($id){

        $event = Event::findOrFail($id);

        if ($event->event_status < 1){

          $event->guestList()->forceDelete();//hard delete
          $event->forceDelete();
        }
        else{

          $event->delete();//soft delete
        }
        return redirect('events');
    }

    public function duplicate($id){
      $event = Event::find($id);
      $list = $event->guestList()->get();

      $guestList = array();
      foreach($list as $li)
      {
          if($li->contact['contact_id'] > 0){
            $guestList[] = $li->contact->toArray();
          }
      }
      return view('eventFolder.duplicateEvent', compact('event', 'guestList'));
    }

    public function duplication(EventRequest $request){

      $request["event_status"] = 0; //better way to do this?

      $event = Event::create($request->all());//still need way to let forms default to today date and time
      $eventId = $event->event_id;

      foreach($request->toArray()['invitelist'] as $invitee)
      {
        GuestList::create(['rsvp' => 0, 'checked_in_by' => null, 'contact_id' => $invitee, 'event_id' => $eventId]);
      }

     return redirect()->action('EventController@show', $eventId);
    }


}
