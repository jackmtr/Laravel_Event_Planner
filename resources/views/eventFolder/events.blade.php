@extends('layouts.app')

@section('content')
	<div class="events">
	    <div class="topevents"> <!-- can be generic -->
	    	<div class="topeventnav"><!-- can be generic -->
		    	<h2>Active Events</h2>
		        <a href="{{ url('/events/create') }}">Add Event</a>
	    	</div>
	    	<div class="openevents"> <!-- can be generic -->
		    	@foreach($eventsWithCount as $openEvent)
          @if($openEvent['event_status'] != 2)
		    		 <div class="singleopenevent">
		    			<div class="singleeventleftbox">
		    				<p>{{$openEvent['event_date']}}</p>
		    				<p>{{$openEvent['event_name']}}</p>
		    				<p>{{$openEvent['event_location']}}</p>
		    			</div>
              @if($openEvent['event_status'] == 0)
		    			<div class="singleeventrightbox" style="background-color: #1e8f98"><!--openeventrightbox $jade -->
			    			<div class="checkedin"><!-- text color to white for openeventrightbox -->
			    				<p>{{$openEvent['count']}}</p>
			    				<p>Invited</p>
                </div>
                <div class="duplicate">
			    				<a href="#">Duplicate</a>
			    			</div>
		    			</div>
              @elseif($openEvent['event_status'] == 1)
              <div class="singleeventrightbox"><!--checkineventrightbox -->
			    			<div class="checkedin">
			    				<p>{{$openEvent['count']}}</p>
			    				<p>Checked in</p>
                </div>
                <div class="duplicate">
			    				<a href="#">Duplicate</a>
			    			</div>
		    			</div>
              @endif
		    		</div>
            @endif
		    	@endforeach
	    	</div>
	    </div>
      <div class="topevents">
	    	<div class="topeventnav">
		    	<h2>Ended Events</h2>
	    	</div>
	    	<div class="openevents">
		    	@foreach($eventsWithCount as $closedEvent)
          @if($closedEvent['event_status'] == 2)
		    		 <div class="singleopenevent"><!--singleclosedevent -->
		    			<div class="singleeventleftbox">
		    				<p>{{$closedEvent['event_date']}}</p>
		    				<p>{{$closedEvent['event_name']}}</p>
		    				<p>{{$closedEvent['event_location']}}</p>
		    			</div>
		    			<div class="singleeventrightbox" style="background-color: #eaeaea"><!-- closedeventrightbox -->
			    			<div class="checkedin">
			    				<p>{{$closedEvent['count']}}</p>
			    				<p>Went</p>
                </div>
                <div class="duplicate">
			    				<a href="#">Duplicate</a>
			    			</div>
		    			</div>
		    		</div>
            @endif
		    	@endforeach
	    	</div>
	    </div>
    </div>
@endsection
