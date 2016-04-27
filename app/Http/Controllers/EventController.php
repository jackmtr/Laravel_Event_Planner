<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests;
use App\EventWithCount;
use App\EventDetails;
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
        $eventsWithCount = array();
        foreach(Event::all() as $event){
          $eventWithCount = new EventWithCount($event);
          $eventsWithCount[] = $eventWithCount;
        }
        return view('eventFolder.events', compact('eventsWithCount'));
    }

    public function create(){
        return view('eventFolder.createEvents');
    }

    public function store(){
        $input = Request::all();
        $input['event_status'] = 0;
        // add date value in front of time value to be 2016-08-12 19:00:00
        Event::create($input);
        return redirect('events');
    }

    public function show($id){
      $eventDetails = new EventDetails($id);
      return view('eventFolder.eventsDetail', compact('eventDetails'));
    }
}
