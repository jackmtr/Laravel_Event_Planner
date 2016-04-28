@extends('layouts.app')
@section('content')

<h3>Event Name</h3>
<div class="eventTitle">
  <h2>{{ $eventDetails['event_name'] }}</h2>
  <a href="{{$eventDetails['event_id']}}/edit">show details</a>
</div>
<div class="eventStatus">
  <h3>Event Status: </h3>
  @if( $eventDetails['event_status']  == 0)
  <span class="statusOpenBtn">Open</span>
  @elseif( $eventDetails['event_status'] == 1)
  <span class="statusCheckInBtn">Check In</span>
  @else
  <span class="statusCompleteBtn">Complete</span>
  @endif
</div>
<input placeholder="Look up names or contact info" />
<div class="guestListCount">
  <div class="guestVariableA">
    @if( $eventDetails['event_status']  == 0)
    <h2>{{ $eventDetails['rsvpYes'] }}</h2>
    <h3>Going</h3>
    @else
    <h2>{{ $eventDetails['checkedIn'] }}</h2>
    @if( $eventDetails['event_status']  == 1)
    <h3>Checked In</h3>
    @else
    <h3>Attended</h3>
    @endif
    @endif
  </div>
  <div class="guestVariableB">
    @if( $eventDetails['event_status']  == 1)
    <h2>{{ $eventDetails['rsvpYes'] }}</h2>
    <h3>Attending</h3>
    @else
    <h2>{{ count($eventDetails['guestList']) }}</h2>
    <h3>Invited</h3>
    @endif
  </div>
</div>
<div class="guestList">
  <table>
		<tr><th>Status</th><th>Table</th><th>Name</th><th>Guests</th><th>Title &amp; Company</th><th>Notes</th></tr>
		@if (count($eventDetails['guestList']) > 0)
			@foreach($eventDetails['guestList'] as $guest)
				<tr>
					<td>{{ $guest['rsvp'] }}</td>
					<td>N/A</td>
					<td>{{$guest['contact_id']}} Get Names</td>
					<td>{{$guest['additional_guests']}}</td>
					<td>{{$guest['contact_id']}} Get Title & Company</td>
					<td>Get Notes</td>
				</tr>
			@endforeach
		@else
				<p>No Guests Exist</p>
		@endif
	</table>
</div>
@endsection
