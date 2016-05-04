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
