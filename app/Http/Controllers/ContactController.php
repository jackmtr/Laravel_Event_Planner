<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Event;
use App\Http\Requests;
//use Carbon\Carbon;
use Auth;
use Illuminate\Http\Request;

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

    public function edit($id){

        $contact = Contact::find($id);

        return view('contactFolder.editContacts', compact("contact"));
    }

    public function update(Request $request, $id)
    {
        //Validating data
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name'  => 'required|max:255',
            'email'      => 'required|max:255',
            /*
            'occupation',
            'company',
            'wechat_id',
            'notes',
            */
            'added_by'   => 'required',           
        ]);
                       
        //Save data to database
        $contact = Contact::find($id);

        $contact->first_name = $request->input('first_name');
        $contact->last_name = $request->input('last_name');        
        $contact->email = $request->input('email');
        $contact->occupation = $request->input('occupation');
        $contact->company = $request->input('company');
        $contact->wechat_id = $request->input('wechat_id');
        $contact->notes = $request->input('notes');
        $contact->added_by = $request->input('added_by');

        $contact->save();
        return redirect('contacts');                    

    }
}