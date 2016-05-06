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

      $authId = Auth::user()->user_id;      
      $addedBy = $authId; 
      $contact = Contact::findOrFail($guest->contact_id);             
      $firstName = "Friend of ". $contact->first_name . " " . $contact->last_name;
      $lastName = $guest->guest_list_id;
      $eventId = $guest->event_id;

      // $findContacts = Contact::where('last_name', '=', $lastName);
      // foreach($findContacts as $findContact){   
      //   $findGuest = GuestList::where('guest_list_id', '=', $findContact->last_name );     
      //   $findGuest->forceDelete();
      // }      
           
      // $findContacts = Contact::where('last_name', 'LIKE', '%'. $lastName . '%');    
      // foreach($findContacts as $findContact){
      //   $findContact->forceDelete();
      // }

      for($i = 0; $i < $request->guests; $i++){        
        $newContact = Contact::create(['first_name' => $firstName, 'last_name' => $lastName, 'added_by'=> $addedBy ]);
        $invitee = $newContact->contact_id;
        GuestList::create(array('rsvp' => 0, 'checked_in_by' => null, 'contact_id' => $invitee, 'event_id' => $eventId));
      }
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
