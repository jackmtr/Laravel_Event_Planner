<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\GuestList;
use Auth;
use App\Event;
use App\Contact;
use App\PhoneNumber;

class GuestListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $authId = Auth::user()->user_id;
        $eventId = $request->events;
        $guestlist = $request->toArray();

        foreach ($guestlist["invitelist"] as $invitee){
            GuestList::create(array('rsvp' => 0, 'checked_in_by' => null, 'contact_id' => $invitee, 'event_id' => $eventId));
        }

        return redirect()->action('EventController@show', $eventId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function SearchHelperMethod ($search, $id, $conditional){


        $guestList = Contact::whereHas('guestList', function ($query) use ($id,$conditional) {

            $query->where('event_id',$conditional , $id);})
            ->where('first_name', 'LIKE', '%'.$search.'%')
            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
            ->get();

        if($guestList->count() > 0){
            return("On guest list");
        }else{
            $guestList = Contact::where('first_name', 'LIKE', '%'.$search.'%')
                ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                ->take(5)->get();
            return ("On contact list");
        }

    }

    public function show( Request $request, $id)
    {
        /**
         * Query for a search name in Contacts table.
         * Check if found names are also inside the GuestList
         * Invited on top
         *
         */
        $search = $request->input('search');
        $event = Event::find($id);
        $events = Event::all();
        $guests = $event->guestList()->get();
        $rsvpYes = count($guests->where('rsvp', 1));
        $checkedIn = count($guests->where('checked_in_by', null));
        $index = 0;

//        $contacts_that_match_search = Contact::where('first_name', 'LIKE','%'.$search.'%')
//                                ->orWhere('last_name', 'LIKE', '%'.$search.'%')
//                                ->get();
//
//        $guests_that_belong_to_event = GuestList::where('event_id',$id)->get();

        $guest_list_contacts = Contact::whereHas('guestList', function ($query) use ($id) {

            $query->where('event_id','=' , $id);})
            ->where('first_name', 'LIKE', '%'.$search.'%')
            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
            ->get();

        $all_contacts_that_match_search = Contact::where('first_name', 'LIKE', '%'.$search.'%')
            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
            ->take(5)->get();


        foreach($all_contacts_that_match_search as $contact){

            if(isset($contact, $guest_list_contacts) == false){
                $contact_not_on_guestlist [] = $contact;
            }elseif(in_array($contact, $guest_list_contacts)){
                return($guest_list_contacts);
            }
        }

        dd($contact_not_on_guestlist);










        //will iterate depending on guest_list return
        foreach($guests_that_belong_to_event as $guest_of_event){

            $guest_of_event_contact_id = $guest_of_event->contact_id;

            foreach($contacts_that_match_search as $matched_contact){

                if($matched_contact->contact_id == $guest_of_event_contact_id){

                    $invited_contacts [] = $matched_contact;

                }elseif($matched_contact->contact_id != $guest_of_event_contact_id){
                    $uninvited_contact [] = $matched_contact;
                    $filtered = array_unique($uninvited_contact);
                }
            }

        }


        dd($uninvited_contact);















//        $guest = GuestList::whereHas('contact', function($query) use ($search) {
//            $query->where('first_name', 'LIKE', '%'.$search.'%')
//                ->orWhere('last_name', 'LIKE', '%'.$search.'%');
//        })->where('event_id',$id)->get();
//
//        if($guest->count() == 0){
//            $guest->push(function($search){
//
//            });
//        }
//
//        dd($guest);


//        $guestList = $this->SearchHelperMethod($search, $id, '=');
          //  return view('eventFolder.eventsDetail', compact('events', 'event', 'guestList', 'rsvpYes','checkedIn','index'));

//            return($guestList);
          //  return view('eventFolder.eventsDetail', compact('events', 'event', 'guestList', 'rsvpYes','checkedIn','index'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $guest = GuestList::findOrFail($request->theGuest);
      $rsvp = $request->theRsvp;
      $message = "RSVP Updated";
      if ($rsvp == "Invited") {
        $guest->rsvp = 0;
      } elseif ($rsvp == "Going") {
        $guest->rsvp = 1;
      } elseif ($rsvp == "Not Going") {
        $guest->rsvp = 2;
      } elseif ($rsvp == "Remove Guest") {
        $this->destroy($guest->guest_list_id);
        $message = "Guest Removed";
      } else {
        $message = "Error";
      }
      $guest->save();
      return $message;
    }

    public function checkin(Request $request)
    {
      $guest = GuestList::findOrFail($request->theGuest);
      $checkin = $request->theCheckin;
      $message = "Check In Status Updated";
      if ($checkin == "Not Checked In") {
        $guest->checked_in_by = null;
      } elseif ($checkin == "Checked In") {
        $guest->checked_in_by = Auth::user()->user_id;
      } else {
        $message = "Error";
      }
      $guest->save();
      return $message;
    }
    public function addguests(Request $request)
    {
      $guest = GuestList::findOrFail($request->theGuest);
      $guest->additional_guests = $request->guests;
      $guest->save();
      return "Additional Guests Updated";
      //$eventid = $request->theEvent;
      // clear guestlist, clear contacts, build new contacts, build new guestlist

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guestList = GuestList::findOrFail($id);
        $eventStatus = $guestList->event->event_status;

        if($eventStatus == 0){
            $guestList->forceDelete();
        }else{
            echo("sorry, you can't delete a guest from a checkedin/completed event!");
        }
    }

    // public function update(ContactRequest $request, $id)
    // {
    //     $contact = Contact::findOrFail($id)->update($request->all());
    //     $phones = $contact->phoneNumber()->get();

    //     return redirect('contacts');
    // }

    //id comes from guestlist
    public function details($id){

            

        $guest = Contact::find($id);
        $phones = $guest->phoneNumber()->get();

        foreach($phones as $phone)
        {
            //dd($phone->phone_number);
        }



        //return $guest->contact_id;
        return view('eventFolder.guestDetails', compact("guest","phones"));
    }

    public function addPhone(Request $request, $contactid)
    {
        $guest = Contact::find($contactid);
        $allNumbers = $request->all();
        $newNumbers = $allNumbers['phone'];
        //dd($newNumbers);


        $affectedRows = $guest->phoneNumber()->get();

        foreach($affectedRows as $row)
        {

            $row->delete();
        }

        foreach ($newNumbers as $number) 
        {
            if($number != "")
            {
                PhoneNumber::create(array('phone_number'=>$number, 'contact_id'=>$contactid));
            }
        }


        return redirect('guestlist/'.$contactid.'/details');
    }

}
