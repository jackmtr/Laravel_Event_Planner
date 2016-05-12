<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Event;
use App\PhoneNumber;
use App\Http\Requests\ContactRequest;
use Request;
use Auth;
use App\User;

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
        $phoneindex = 0;
        $open_events = Event::where('event_status', '<', 2)->orderBy('event_status')->get();

        if(Request::input('sortby')){
          $sortby = Request::input('sortby');
        }

        $contacts = Contact::orderBy($sortby)->paginate(10)->appends(['sortby' => $sortby]);

        if(Request::input('searchitem')){ 
            $query = Request::input('searchitem'); 
            $contacts = Contact::where('first_name', 'LIKE', '%'. $query . '%')
                ->orWhere('last_name', 'LIKE', '%'. $query . '%')
                ->orWhere('email', 'LIKE', '%' . $query . '%')
                ->orWhere('occupation', 'LIKE', '%' . $query . '%')
                ->orWhere('company', 'LIKE', '%' . $query . '%')->paginate(10);
        }

        foreach($contacts as $contact){

            $previousEvent = array();
            $anyPhone = $contact->phoneNumber()->first();

            if ($anyPhone){
                $contact->display_phoneNumber = $anyPhone->phone_number;
            }else{
                $contact->display_phoneNumber = "N/A";
            }

            $guestsinfo = $contact->guestList()->get();

            foreach($guestsinfo as $previousGuest){
                $previousEvent[] = $previousGuest->event['event_name'];
            }

            $contact->previous_event = $previousEvent;
                 
            $whoAdded = User::find($contact->added_by)->name;
            $contact->whoAdded = $whoAdded;          
        } 

    	return view('contactFolder.contacts', compact('contacts','open_events', 'phoneindex'));
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

        foreach($request['phonegroup'] as $phoneNumber){

            if (strlen($phoneNumber) > 1){
                PhoneNumber::create(array('phone_number'=>$phoneNumber, 'contact_id'=>$contact->contact_id));
            }
        }

        flash('You have successfully added a contact!');

        return redirect('contacts');
    }

    public function update(ContactRequest $request, $id)
    {

        $eventId = $request->event_id;

        $guest = Contact::findOrFail($id);
        $contact = $guest->update($request->all());

        $currentNumbers = $guest->phoneNumber()->get();
        $allNumbers = $request->phonegroup;

        foreach($currentNumbers as $row)
        {
            $row->forceDelete();
        }

        foreach ($allNumbers as $number) 
        {
            if(strlen($number) > 1)
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

        $contact = Contact::findOrFail($id);

        $contactInGuestLists = count($contact->guestlist);

        if($contactInGuestLists == 0){

            $contact->phoneNumber()->forceDelete();
            $contact->forceDelete();
        }else{

            $contact->phoneNumber()->delete();
            $contact->delete();
        }
        return redirect('contacts');
    }
}
