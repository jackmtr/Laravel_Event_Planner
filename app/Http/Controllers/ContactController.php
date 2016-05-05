<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Event;
use App\GuestList;
use App\PhoneNumber;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request; //needed for the search function atm
use Auth;
use Illuminate\Http\Response;

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
    public function search_post(Request $request){
        $term = $request->input('search');

        $results = array();
        $contacts = Contact::
        where('first_name', 'LIKE', '%'.$term.'%')
            ->orWhere('last_name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        $events_active_open = Event::where('event_status', '<', 2)->orderBy('event_status')->get();
        if ($contacts->count() > 0){
//            foreach ($queries as $query)
//            {
//                $results[] = [ 'id' => $query->contact_id, 'value' => $query->first_name.' '.$query->last_name ];
//            }
//            return response()->json($results);
//            return view('contactFolder.ajaxPracticeView', compact('contacts','events_active_open'));
           return response()->json($contacts);

        }
    }

    public function search(Request $request){

        $term = $request->input('term');

        $results = array();



        $contacts = Contact::
            where('first_name', 'LIKE', '%'.$term.'%')
            ->orWhere('last_name', 'LIKE', '%'.$term.'%')
            ->take(5)->get();
        $events_active_open = Event::where('event_status', '<', 2)->orderBy('event_status')->get();
        if ($contacts->count() > 0){
//            foreach ($queries as $query)
//            {
//                $results[] = [ 'id' => $query->contact_id, 'value' => $query->first_name.' '.$query->last_name ];
//            }
//            return response()->json($results);
            return view('contactFolder.ajaxPracticeView', compact('contacts','events_active_open'));
        }


    }


    public function index(Request $request) //shows all contacts
    {
        $sortby = "last_name";

        if($request->input('sortby')){
          $sortby = $request->input('sortby');
        }

        $contacts = Contact::orderBy($sortby)->paginate(10)->appends(['sortby' => $sortby]);

        if($request->input('searchitem')){ //if come from any type of form, enter the if.  if come here with no search, skip the if statement
            $query = $request->input('searchitem'); //look for only the input called searchitem
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
        } //for every contact, look for any number.  if finds one, put into a attribute called display_phoneNumber.  Put it empty if there's no number.

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
