<?php

namespace App\Http\Controllers;

use App\Event;
use App\GuestList;
use App\Contact;
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

            $count = count($guests);
          }else{

            $count = count($guests) - count($guests->where('checked_in_by', null));
          }

          $eventWithCount = new EventWithCount($event, $count);
          $eventsWithCount[] = $eventWithCount;

        }
        return view('eventFolder.events', compact('eventsWithCount'));
    }

    public function create(){

        return view('eventFolder.createEvents');
    }

    public function store(EventRequest $request){

        Event::create($request->all());
        return redirect('events');
    }

    public function show($id)
    {
      $comeFromSearch = 0;
      $query = "";

      $event = Event::findOrFail($id); //get event details to pass to view
      $events = Event::all();

      $guests = array();
      $guestMatches = array();
        $guestList = array(); //guestList contact details to pass to view

      $contacts = array();
      $contactMatches = array();
        $contactList = array();

      if(Request::input('searchitem')){

        $comeFromSearch = 1;

        $query = Request::input('searchitem');

        $contactMatches = Contact::withTrashed()->where('first_name', 'LIKE', '%'. $query . '%')
          ->orWhere('last_name', 'LIKE', '%'. $query . '%')->get()->toArray();

        $contactMatchesIds = array_column($contactMatches, 'contact_id');

        $eventGuests = Event::find($id)->guestList;

        foreach($eventGuests as $guest){
          $guestMatches[] = $guest->contact->toArray();
        }

        $guestMatchesIds = array_column($guestMatches, "contact_id");

        foreach($contactMatchesIds as $matcher){
          if (in_array($matcher, $guestMatchesIds)){
            $guests[] = Contact::find($matcher)->guestList()->get()->first();
          }else{
            $contacts[] = Contact::find($matcher);
          }
        }

      }else{
        $allGuests = $event->guestList()->get();

        foreach($allGuests as $guest ){
          $guests[] = $guest;
        }
      }

      foreach( $guests as $guest)
      {

        $oneGuest['guest_list_id'] = $guest->guest_list_id;
        $oneGuest['rsvp'] = $guest->rsvp;
        $oneGuest['additional_guests'] = $guest->additional_guests;
        $oneGuest['checked_in_by'] = $guest->checked_in_by;
        $oneGuest['note'] = $guest->contact()->withTrashed()->first()->notes;

        $first_name = $guest->contact()->withTrashed()->get()->toArray()[0]['first_name'];
        $last_name = $guest->contact()->withTrashed()->get()->toArray()[0]['last_name'];
        $oneGuest['name'] = $first_name . " " . $last_name;

        $occupation = $guest->contact()->withTrashed()->get()->toArray()[0]['occupation'];
        $company = $guest->contact()->withTrashed()->get()->toArray()[0]['company'];
        $oneGuest['work'] = $occupation . " " . $company;

        $oneGuest['contact'] = $guest->contact()->withTrashed()->first();
        $oneGuest['phone_number'] = $guest->contact()->withTrashed()->first()->phoneNumber()->get()->toArray();

        $guestList[] = $oneGuest;
      }

      $index = 0;
      $phoneindex = 0;

      foreach($contacts as $guest){

        $oneGuest['guest_list_id'] = "";
        $oneGuest['rsvp'] = "";
        $oneGuest['additional_guests'] = "";
        $oneGuest['checked_in_by'] = "";
        $oneGuest['note'] = $guest->notes;

        $first_name = $guest->first_name;
        $last_name = $guest->last_name;
        $oneGuest['name'] = $first_name . " " . $last_name;

        $occupation = $guest->occupation;
        $company = $guest->company;
        $oneGuest['work'] = $occupation . " " . $company;

        $oneGuest['contact'] = $guest;

        $oneGuest['phone_number'] = $guest->first()->phoneNumber()->get();
        $contactList[] = $oneGuest;
      }

      $guests = $event->guestList()->get();

      $rsvpYes = count($guests->where('rsvp', 1)); //count of guestList rsvp yes to pass to view
      $checkedIn =count($guests) - count($guests->where('checked_in_by', null)); //count of guestList already checked in to pass to view

      return view('eventFolder.eventsDetail', compact('events', 'event', 'guestList', 'rsvpYes','checkedIn','index', 'phoneindex', 'contactList', 'comeFromSearch', 'query'));
    }

    public function update(EventRequest $request, $id)
    {
        $event = Event::findOrFail($id)->update($request->all());

        return redirect()->action('EventController@show', $id);
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

      $duplicateEvent = $event->toArray();
      $duplicateEvent["event_name"] = $duplicateEvent["event_name"] . " " . date("F j, Y");
      $duplicateEvent["event_status"] = 0;
      $duplicateEvent["event_date"] = null;
      $duplicateEvent["event_time"] = null;

      $newEvent = Event::create($duplicateEvent);
      $newEventId = $newEvent->event_id;

      foreach($guestList as $invitee)
      {
        GuestList::create(['rsvp' => 0, 'checked_in_by' => null, 'contact_id' => $invitee["contact_id"], 'event_id' => $newEventId]);
      }

      return redirect()->action('EventController@show', $newEventId);
    }

    public function invitePreviousGuests($id){
      if(Request::input('events')){
        $previousGuestList = Event::findOrFail(Request::input('events'))->guestList()->get();

        foreach ($previousGuestList as $previousGuest) {
          if($previousGuest->contact['contact_id'] > 0){
            GuestList::create(['rsvp' => 0, 'checked_in_by' => null, 'contact_id' => $previousGuest->contact['contact_id'], 'event_id' => $id]);
          }
        }
      }
      return redirect()->action('EventController@show', $id);
    }

    public function toggleStatus(Request $request){
      $event = Event::findOrFail(Request::input('theEvent'));
      $status = Request::input('theStatus');
      $message = "Status Changed";
      if ($status == "OPEN") {
        $event->event_status = 0;
      } elseif ($status == "CHECK-IN") {
        $event->event_status = 1;
      } elseif ($status == "COMPLETED") {
        $event->event_status = 2;
      } else {
        $message = "Error";
      }
      $event->save();
      return $message;
    }
}
