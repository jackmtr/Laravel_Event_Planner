<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Event;
use App\GuestList;
use App\PhoneNumber;
use App\Http\Requests\ContactRequest;
use Request; //needed for the search function atm
use Auth;

class ContactController extends Controller
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
    public function index() //shows all contacts
    {
        $sortby = "last_name";

        if(Request::input('sortby')){
          $sortby = Request::input('sortby');
        }

        $contacts = Contact::orderBy($sortby)->paginate(10)->appends(['sortby' => $sortby]);

        if(Request::input('searchitem')){ //if come from any type of form, enter the if.  if come here with no search, skip the if statement
            $query = Request::input('searchitem'); //look for only the input called searchitem
            $contacts = Contact::where('first_name', 'LIKE', '%'. $query . '%')
                ->orWhere('last_name', 'LIKE', '%'. $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')->paginate(10);
                //search by first/last/and email
        }
        foreach($contacts as $contact){

            $anyPhone = $contact->phoneNumber()->first();

            if ($anyPhone){
                $contact->display_phoneNumber = $anyPhone->phone_number;
            }else{
                $contact->display_phoneNumber = "";
            }

            $previousEvent = array();

            $guestsinfo = $contact->guestList()->get();

            foreach($guestsinfo as $previousGuest){
                $previousEvent[] = $previousGuest->event['event_name'];
            }

            $contact->previous_event = $previousEvent;

        } //for every contact, look for any number.  if finds one, put into a attribute called display_phoneNumber.  Put it empty if there's no number.

        $events_active_open = Event::where('event_status', '<', 2)->orderBy('event_status')->get();

        $phoneindex = 0;

    	return view('contactFolder.contacts', compact('contacts','events_active_open', 'phoneindex'));
    }

    public function create()
    {
        $phoneindex = 0;
        return view('contactFolder.createContacts', compact('phoneindex'));
    }

    public function store(ContactRequest $request){

        $request["added_by"] = Auth::user()->user_id;
        $contact = Contact::create($request->all());

        $request["contact_id"] = $contact->contact_id;

        /*if (strlen($request["phone_number"]) > 1){
            PhoneNumber::create($request->all()); 
        }*/
        foreach($request['phonegroup'] as $phoneNumber){
            //dd($phoneNumber);
            if (strlen($phoneNumber) > 1){
                PhoneNumber::create(array('phone_number'=>$phoneNumber, 'contact_id'=>$contact->contact_id));
            }
        }

        return redirect('contacts');
    }

    public function update(ContactRequest $request, $id)
    {
        $eventId = $request->event_id;
        
        $contact = Contact::findOrFail($id)->update($request->all());

        $guest = Contact::find($id);
        $allNumbers = $request->all();
        $newNumbers = $allNumbers['phonegroup'];


        $affectedRows = $guest->phoneNumber()->get();

        foreach($affectedRows as $row)
        {

            $row->delete();
        }

        foreach ($newNumbers as $number) 
        {
            if($number != "")
            {
                PhoneNumber::create(array('phone_number'=>$number, 'contact_id'=>$id));
            }
        }

        if ($eventId != null){
            return redirect()->action('EventController@show', $eventId);
        }
        else{
            return redirect('contacts'); 
        }
    }

    public function destroy($id){

        //if the $id is not found in the guestlist table, this contact may be hard deleted
        $contact = Contact::findOrFail($id);

        $contactInGuestLists = count($contact->guestlist);

        if($contactInGuestLists == 0){
            //can hard delete
            $contact->phoneNumber()->forceDelete();
            $contact->forceDelete();
        }else{
            //dont hard delete
            $contact->phoneNumber()->delete();
            $contact->delete();
        }
        return redirect('contacts');
    }


}
