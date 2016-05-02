<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\GuestList;
use App\Http\Requests;
use Auth;
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
        
        //dd($authId);
        $guestlist = $request->toArray();

        $count = "";
        foreach ($guestlist["invitelist"] as $invitee){

            GuestList::create(array('rsvp' => 0, 'checked_in_by' => $authId, 'contact_id' => $invitee, 'event_id' => $eventId));

        }

        return "done";
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //couldnt test this code out since no view, so adjust accordinaly
        $eventId = GuestList::find($id)->event_id;
        $eventStatus = Event::find($eventId)->event_status;

        if($eventStatus == 0){
            GuestList::find($id)->forceDelete();
        }else{
            alert("sorry, you can't delete a guest from a checkedin/completed event!");
        }
    }

    //id comes from guestlist
    public function details(Request $request, $id){

        $guest = Contact::find($id);
        $phone = PhoneNumber::where('contact_id',$id)->firstOrFail()->phone_number;

        $data = $request->all();
        if($request->ajax())
        {
            $id = Request::input('id');
            $number = PhoneNumber::where('id', $id)->first();
            $number->update();
        }


        //return $guest->contact_id;
        return view('eventFolder.guestDetails', compact("guest","phone"));
    }
}
