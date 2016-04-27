<?php

namespace App\Http\Controllers;

use App\Event;
use App\Http\Requests;
use App\EventWithCount;
//use Carbon\Carbon;
//use Illuminate\Http\Request;
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

        foreach(Event::latest("event_status")->get() as $event){
          $eventWithCount = new EventWithCount($event);
          $eventsWithCount[] = $eventWithCount;
        }
        return view('eventFolder.events', compact('eventsWithCount'));
    }

    public function create(){
        return view('eventFolder.createEvents');
    }

    public function store(){
        //dd(Request::all());
        Event::create(Request::all());

        return redirect('events');
    }

    public function edit($id){

        $event = Event::findOrFail($id);

        return view('eventFolder.editEvents', compact("event"));
    }

    public function update(Request $request, $id)
    {
        //Validating data
        $this->validate($request, [
            'event_name' => 'required|max:255',
            'event_date' => '',
            'num_of_tables' => 'integer',
            'seats_per_table' => 'integer',

        ]);
                       
        //Save data to database
        $event = Event::find($id);
        //dd($request->input('event_name'));
        
        $event->event_name = $request->input('event_name');
        $event->event_date = $request->input('event_date');
        $event->event_time = $request->input('event_time');
        $event->event_location = $request->input('event_location');
        $event->event_description = $request->input('event_description');
        $event->num_of_tables = $request->input('num_of_tables');
        $event->seats_per_table = $request->input('seats_per_table');

        $event->save();
        return redirect('events');
    }
}
