@extends('layouts.app')

@section('content')
    <div>
    	<a href="{{ url('/events/create') }}"> (icon) Add Event</a>
        <h2>Active Events</h2>
        
		<table class="table-wrapper">
		<tr>
			<th>Event</th>
			<th>Status</th>
			<th>Date</th>
			<th>Time</th>
			<th>Location</th>
			<th>Description</th>
			<th># of Tables</th>
			<th># Seats per Table</th>
		</tr>
		@if (count($openEvents))
			@foreach($openEvents as $openEvent)
				<tr>
				<td>{{ $openEvent['event_name'] }}</td>
				<td>
					@if ( $openEvent['event_status'] == 0)
					OPEN
					@endif
				</td>
				<td>{{$openEvent['event_date']}}</td>
				<td>{{$openEvent['event_time']}}</td>
				<td>{{$openEvent['event_location']}}</td>
				<td>{{$openEvent['event_description']}}</td>
				<td>{{$openEvent['num_of_tables']}}</td>
				<td>{{$openEvent['seats_per_table']}}</td>
				</tr>

			@endforeach
		@else
				<p>No Contacts Exist</p>
		@endif
		</table>

    </div>
    <div>
        <h2>Ended Events</h2>
        <table>
		<tr><th>Event</th><th>Status</th><th>Date</th><th>Time</th><th>Location</th><th>Description</th><th># of Tables</th><th># Seats per Table</th></tr>        	
        	
        </table>
    </div>
@endsection
