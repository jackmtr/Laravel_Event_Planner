<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Event;
use App\Http\Requests;
//use Carbon\Carbon;
use Auth;
use Request;

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
        $contacts = Contact::paginate(10);
        $events_active_open = Event::where('event_status', 0)->orWhere('event_status',1)->get();

       // $contacts = Contact::all();

    	return view('contactFolder.contacts', compact('contacts','events_active_open'));
    }

    public function create()
    {
        return view('contactFolder.createContacts');
    }

    public function store(Request $request){

        $authId = Auth::user()->user_id;
        //dd($authEmail);
        $input = Request::all();
        $input["added_by"] = $authId;
        //dd($input);

        Contact::create($input);

        return redirect('contacts');
    }
}