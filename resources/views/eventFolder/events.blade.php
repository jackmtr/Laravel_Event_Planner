@extends('layouts.app')

@section('content')
<h1>
    <div>
    	<a href="{{ url('/events/create') }}"> (icon) Add Event</a>
        <h1>Active Events</h1>
        
		<table>
		<tr><th>Event</th><th>Status</th><th>Date</th><th>Time</th><th>Location</th><th>Description</th><th># of Tables</th><th># Seats per Table</th></tr>
		@if (count($openEvents))
			@foreach($openEvents as $openEvent)
				<tr>
				<td>{{{ $openEvent['eventName']}}}</td>
				<td>
					@if ( $openEvent['eventStatus'] == 0)
					OPEN
					@endif
				</td>
				<td>{{{$openEvent['eventDate']}}}</td>
				<td>{{{$openEvent['eventTime']}}}</td>
				<td>{{{$openEvent['location']}}}</td>
				</tr>

			@endforeach
		@else
				<p>No Contacts Exist</p>
		@endif
		</table>

    </div>
    <div>
        <h1>Ended Events</h1>
        <table>
		<tr><th>Event</th><th>Status</th><th>Date</th><th>Time</th><th>Location</th><th>Description</th><th># of Tables</th><th># Seats per Table</th></tr>        	
        	
        </table>
    </div>
</h1>
@endsection
