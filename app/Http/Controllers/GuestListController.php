<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\GuestList;
use Auth;
use App\Event;

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
    public function update(Request $request, $id)
    {
        //


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
}
