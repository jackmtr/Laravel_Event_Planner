<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Event;
use App\PhoneNumber;
use App\Http\Requests\ContactRequest;
use App\Http\Requests;
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
    public function index()
    {
        $contacts = Contact::orderBy("last_name")->paginate(10);        

        if(Request::all()){
            $query = Request::input('searchitem');
            $contacts = Contact::where('first_name', 'LIKE', '%'. $query . '%')->orWhere('last_name', 'LIKE', '%'. $query . '%')->paginate(10);          
        }

        $events_active_open = Event::where('event_status', 0)->orWhere('event_status',1)->get();

    	return view('contactFolder.contacts', compact('contacts','events_active_open'));
    }

    public function create()
    {
        return view('contactFolder.createContacts');
    }

    public function store(ContactRequest $request){

        $authId = Auth::user()->user_id;
        $request["added_by"] = $authId;

        $contact = Contact::create($request->all());

        $request["contact_id"] = $contact->contact_id; //must be after contact create so i can pull the contact_id for the forein key in phone table
        PhoneNumber::create($request->all()); //request has the phone number already

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

        $event = Contact::find($id);

        $event->delete();

        return redirect('contacts');
    }    
}