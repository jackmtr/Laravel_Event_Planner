@extends('layouts.app')
@section('content')
<h3>Event Name</h3>
<div class="eventTitle">
  <h2>{{ $eventDetails['event_name'] }}</h2>
  <a href="events/{{$eventDetails['event_id']}}/edit">show details</a>
</div>
<div class="eventStatus">
  <h3>Event Status: </h3>
  @if({{ $eventDetails['event_status'] }} == 0)
  <span class="statusOpenBtn">Open</span>
  @elseif({{ $eventDetails['event_status'] }} == 1)
  <span class="statusCheckInBtn">Check In</span>
  @else
  <span class="statusCompleteBtn">Complete</span>
  @endif
</div>
<!-- <input placeholder="Look up names or contact info" /> -->
<div class="guestListCount">
  <div class="guestVariableA">
    @if({{ $eventDetails['event_status'] }} == 0)
    <h2>{{ $eventDetails['rsvpYes'] }}</h2>
    <h3>Going</h3>
    @else
    <h2>{{ $eventDetails['checkedIn'] }}</h2>
    @if({{ $eventDetails['event_status'] }} == 1)
    <h3>Checked In</h3>
    @else
    <h3>Attended</h3>
    @endif
    @endif
  </div>
  <div class="guestVariableB">
    @if({{ $eventDetails['event_status'] }} == 1)
    <h2>{{ $eventDetails['rsvpYes'] }}</h2>
    <h3>Attending</h3>
    @else
    <h2>{{ count($eventDetails['guestList']) }}</h2>
    <h3>Invited</h3>
    @endif
  </div>
</div>
@endsection
