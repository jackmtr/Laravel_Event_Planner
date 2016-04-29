<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Event;
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
        $contacts = Contact::orderBy("last_name")->paginate(10);//by default contact list will be organized by last name. A->Z        

        if(Request::all()){ //if come from any type of form, enter the if.  if come here with no search, skip the if statement
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
        }//for every contact, look for any number.  if finds one, put into a attribute called display_phoneNumber.  Put it empty if there's no number.

        $events_active_open = Event::where('event_status', '<', 2)->orderBy('event_status')->get();

    	return view('contactFolder.contacts', compact('contacts','events_active_open'));
    }

    public function create()
    {
        return view('contactFolder.createContacts');
    }

    public function store(ContactRequest $request){

        $authId = Auth::user()->user_id;

        $request["added_by"] = $authId;//might be a better way to do this

        $contact = Contact::create($request->all());

        $request["contact_id"] = $contact->contact_id; //must be after contact create so i can pull the contact_id for the forein key in phone table

        if (strlen($request["phone_number"]) > 1){
            PhoneNumber::create($request->all()); //request has the phone number already
        }
        
        return redirect('contacts');
    }

    public function edit($id){

        $contact = Contact::findOrFail($id);

        return view('contactFolder.editContacts', compact("contact"));
    }

    public function update(ContactRequest $request, $id)
    {
        $contact = Contact::findOrFail($id)->update($request->all());

        return redirect('contacts');                    
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