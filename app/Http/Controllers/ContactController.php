<?php

namespace App\Http\Controllers;

use App\Contact;
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
        $contacts = Contact::all()->toArray();

    	return view('contactFolder.contacts', compact('contacts'));
    }

    public function create()
    {
        return view('contactFolder.createContacts');
    }

    public function store(Request $request){

        $authEmail = Auth::user()->email;
        //dd($authEmail);
        $input = Request::all();
        $input["added_by"] = $authEmail;
        //dd($input);

        Contact::create($input);

        return redirect('contacts');
    }
}