<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests;
use App\EventWithCount;
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

        Event::create($input);

        return redirect('events');
    }

}
