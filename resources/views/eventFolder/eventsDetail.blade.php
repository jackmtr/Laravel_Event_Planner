@extends('layouts.app')
@section('content')
  <div class="container">
    <div class="subnav">
      <div class="leftside">
        <h3>Event Name</h3>
        <h2>
          {{ $event['event_name'] }}
          <span><a href="{{$event['event_id']}}/edit">show details</a></span>
        </h2>
        
        <input type="text" name="s" class="contact-searchbar search rounded" placeholder="[ ? ]Look up names or contact info" />

        <div id="invitePrevious">
          {!! Form::open(['action' => ['EventController@show', $event->event_id], 'novalidate' => 'novalidate', 'files' => true, 'name'=>'previous_guests_submit']) !!}  
            
            <label for="events">Invite Guests from a Previous Event: </label>
            <select id="events" name="events" />
              @foreach($events as $pastEvent)
                <option value="{{$pastEvent['event_id']}}">{{$pastEvent['event_name']}}</option>
              @endforeach
            </select>
            <input type="submit" name="guest_list_submit" value="Invite">
          {{Form::close()}}
        </div>    
      </div>

      <div class="rightside">
        <div class="eventStatus">
          {!! Form::label('event_status', 'Event Status:' )!!}
          {!! Form::select('event_status', [0 => 'OPEN', 1 => 'CHECK-IN', 2 => 'COMPLETED'], $event['event_status'], ['class' => 'openmode'] ) !!}
        
          <!--<h3>Event Status: 
            @if( $event['event_status'] == 0)
              <span class="statusOpenBtn">Open</span>
            @elseif( $event['event_status'] == 1)
              <span class="statusCheckInBtn">Check In</span>
            @else
              <span class="statusCompleteBtn">Complete</span>
            @endif
          </h3>-->
        </div>
        <div class="guestListCount">
          <div class="guestVariableA">
            @if( $event['event_status']  == 0)
              <h2>{{ $rsvpYes }}</h2>
              <h3>Going</h3>
            @else
              <h2>{{ $checkedIn }}</h2>
              @if( $event['event_status']  == 1)
                <h3>Checked In</h3>
              @else
                <h3>Attended</h3>
              @endif
            @endif
          </div>
          <div class="guestVariableB">
            @if( $event['event_status']  == 1)
              <h2>{{ $rsvpYes }}</h2>
              <h3>Attending</h3>
            @else
              <h2>{{ count($guestList) }}</h2>
              <h3>Invited</h3>
            @endif
          </div>
        </div>        
      </div>
    </div>

    <div class="guestList">
      <table class="sg-table">
        <tr>
          <th>Status</th>
          <th>Table</th>
          <th>Name</th>
          <th>Guests</th>
          <th class="responsive-remove">Title &amp; Company</th>
          <th class="responsive-remove">Notes</th>
        </tr>
        
        @foreach($guestList as $guest)
        <tr>
          <td>{!! Form::select('rsvp', [0 => 'Invited', 1 => 'Going', 2 => 'Not Going'], $guest['rsvp'], ['class' => 'invited'] ) !!}</td>
          <td>N/A</td>
          <td>{{$guest['name']}}</td>
          <td>
            <form id='myform' method='POST' action='#'>
              <input type='button' value='-' class='qtyminus' field='quantity{{$index}}' />
              <input type='number' name='quantity{{$index}}' value={{ $guest['additional_guests'] }} class='qty' />
              <input type='button' value='+' class='qtyplus' field='quantity{{$index}}' />
            </form>
          </td>
          <td class="responsive-remove">{{$guest['work']}}</td>
          <td class="responsive-remove">{{$guest['note']}}</td>
        </tr>
        <!--{{$index++}}-->
        @endforeach
      </table>
    </div>
    @endsection
    @section('javascript')
    <script>
    $(document).ready(function(){
        // This button will increment the value
        $('.qtyplus').click(function(e){
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input[name='+fieldName+']').val(currentVal + 1);
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0);
            }
        });
        // This button will decrement the value till 0
        $(".qtyminus").click(function(e) {
            // Stop acting like a button
            e.preventDefault();
            // Get the field name
            fieldName = $(this).attr('field');
            // Get its current value
            var currentVal = parseInt($('input[name='+fieldName+']').val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input[name='+fieldName+']').val(currentVal - 1);
            } else {
                // Otherwise put a 0 there
                $('input[name='+fieldName+']').val(0);
            }
        });
    });
    </script>
  </div>
@endsection
