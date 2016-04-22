<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests;
//use Carbon\Carbon;
use Request;

class EventController extends Controller
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
        $openEvents = Event::where('event_status', 0)->get();
        $checkInEvents = Event::where('event_status', 1)->get();
        $completedEvents = Event::where('event_status', 2)->get();

        return view('eventFolder.events', compact('openEvents', 'checkInEvents', 'completedEvents'));
    }

    public function create(){
        return view('eventFolder.createEvents');
    }

    public function store(){
        
        $input = Request::all();
        $input['event_status'] = 0;
        
        Event::create($input);

        return redirect('events');
    }

}
