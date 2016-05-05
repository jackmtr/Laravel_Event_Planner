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
    public function show( Request $request, $id)
    {
        //

      //  $event  = Event::findOrFail($id);
        $search = $request->input('search');
        /**
         * Query for a search name in Contacts table.
         * Check if found names are also inside the GuestList
         *
         */

        $contact = Contact::
        where('first_name', 'LIKE', '%'.$search.'%')
            ->orWhere('last_name', 'LIKE', '%'.$search.'%')
            ->take(5)->get();
        if($contact->count() > 0){
            foreach($contact as $contact_person)
            {
                $contact_query_id [] = $contact_person['contact_id'];
                //dd($contact_query_id);
            }

            $guest_list = GuestList::where('contact_id',$contact_query_id)->where('event_id',$id)->take(3)->get();
            if($guest_list->count() > 0){
                foreach($guest_list as $guest){
                   $guestList = $guest->contact()->get();
                    return view();
                }
            }else{
                return($contact);
            }

            // $guest_list_contact = $contact->guestList()->get();
            // $roles = App\User::find(1)->roles()->orderBy('name')->get();
            // $name = $contact['first_name'];


        }else{
            return("No contact found");
        }

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
