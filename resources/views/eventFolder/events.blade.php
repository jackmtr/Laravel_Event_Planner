@extends('layouts.app')

@section('content')
	<div class="events">
	    <div class="topevents">
	    	<div class="topeventnav">
		    	<h2>Active Events</h2>
		        <a href="{{ url('/events/create') }}">Add Event</a>
	    	</div>
	    	<div class="openevents">
		    	@foreach($eventsWithCount as $openEvent)
		    		<div class="singleopenevent">
		    			<div class="singleeventleftbox">
		    				<p>{{$openEvent['event_date']}}</p>
		    				<p>{{$openEvent['event_name']}}</p>
		    				<p>{{$openEvent['event_location']}}</p>
		    			</div>
		    			<div class="singleeventrightbox">
			    			<div class="checkedin">
			    				<p>120</p>
			    				<p>Checked In</p>			    				
			    			</div>
			    			<div class="duplicate">
			    				<a href="#">Duplicate</a>
			    			</div>
		    			</div>
		    		</div>
		    	@endforeach
	    	</div>
	    </div>
	    <div class="completedevents">
	        <h2>Ended Events</h2>
	    </div>
    </div>
@endsection
