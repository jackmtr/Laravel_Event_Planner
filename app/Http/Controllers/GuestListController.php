<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\GuestList;
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
        $guestList = GuestList::findOrFail($id);
        $eventStatus = $guestList->event->event_status;

        if($eventStatus == 0){
            $guestList->forceDelete();
        }else{
            alert("sorry, you can't delete a guest from a checkedin/completed event!");
        }
    }

    //id comes from guestlist
    public function details($id){

            

        $guest = Contact::find($id);
        $phones = $guest->phoneNumber()->get();



        //return $guest->contact_id;
        return view('eventFolder.guestDetails', compact("guest","phones"));
    }

    public function addPhone(Request $request, $contactid)
    {
        $guest = Contact::find($contactid);
        $newNumbers = Request::all();
        $oldNumbers = $guest->phoneNumber()->get();

        foreach ($oldNumbers as $number) {
            //if(count )

                //get the count of oldnumber and compare it to new numbers 
                //cycle thorugh  new number and longer oen adn override it
                //if count != null create 
                //update

        }

        if($request->() )
        {
             $phoneid = Request::input('phone_number_id');
            if($phoneid != null)
            {
                $number = PhoneNumber::where('phone_number_id', $phoneid)->first();
                $number->update();
            }
            else 
            {
                PhoneNumber::create($request->all());

            }
        }

        return redirect('guestlist/'.$contactid.'/details');
    }

}
