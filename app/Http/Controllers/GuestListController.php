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
    public function create(Request $request)
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
      $firstName = "Friend of ". $contact->first_name;
      $lastName = $contact->last_name;
      $guestOfId = $guest->guest_list_id;
      $eventId = $guest->event_id;
      $email = $contact->email;

      $findContacts = Contact::where('guest_of_id', '=', $guestOfId)->get();


      foreach($findContacts as $findContact){
        $invitee = $findContact->contact_id;
        $findGuest = GuestList::where('contact_id', '=', $invitee);
        if($findGuest != null){
          $findGuest->forceDelete(); // First we need to delete data from guest_lists table
        }
        $findContact->forceDelete(); // Deleting data from contacts table
      }

      for($i = 0; $i < $request->guests; $i++){
        $newContact = Contact::create(['first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'added_by'=> $addedBy, 'guest_of_id'=> $guestOfId  ]);
        $invitee = $newContact->contact_id;
        GuestList::create(array('rsvp' => 0, 'checked_in_by' => null, 'contact_id' => $invitee, 'event_id' => $eventId));
      }
    }

    public function invite(Request $request)
    {
      $eventId = $request->eventId;
      GuestList::create(array('rsvp' => 0, 'checked_in_by' => null, 'contact_id' => $request->contactId, 'event_id' => $eventId));
      return redirect()->action('EventController@show', $eventId);
    }

    public function createContactGuest(Request $request)
    {
      $eventId = $request->eventId;
      $request["added_by"] = Auth::user()->user_id;
      $newContact = Contact::create(['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email, 'occupation' => $request->occupation, 'company' => $request->company, 'wechat_id'=> $request->wechat_id, 'notes' => $request->notes, 'added_by'=> $request->added_by  ]);
      $newContactId = $newContact->contact_id;
      foreach($request['phonegroup'] as $phoneNumber){
          if (strlen($phoneNumber) > 1){
              PhoneNumber::create(array('phone_number'=>$phoneNumber, 'contact_id'=>$newContactId));
          }
      }
      GuestList::create(['rsvp' => 0, 'checked_in_by' => null, 'contact_id' => $newContactId, 'event_id' => $eventId ]);
      return redirect()->action('EventController@show', $eventId);
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
}
