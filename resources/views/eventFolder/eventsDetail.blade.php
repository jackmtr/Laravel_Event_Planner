@extends('layouts.app')
@section('content')
  <div class="container" ng-app="">
    <div class="subnav">

      <div class="leftside">
        <h3>Event Name</h3>
        <h2>
          {{ $event['event_name'] }}
          <span><a href="#" class="showDetails">show details</a></span>
        </h2>  
      </div>

      <div id="showDetails" class="middleside popup-form" hidden>
        <h2>Edit Event {!! $event->event_name !!}</h2>
        {!! Form::model($event, ['method' => 'PATCH', 'action' => ['EventController@update', $event->event_id],'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
            @include('eventFolder._eventForm', ['submitButtonText' => 'Edit Event'])
        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'url' => 'events/' . $event->event_id, 'class' => 'form']) !!}
        {!! Form::submit("Delete Event", ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::close() !!}

        @include('errors._list')   
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

    <div class="subnav">
      <div>
        <input type="text" name="s" class="contact-searchbar search rounded" placeholder="[ ? ]Look up names or contact info" />
      </div>
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
        @if( $event['event_status']  == 0) <!--Open-->
          @foreach($guestList as $guest)            
                <tr>
                  <td>{!! Form::select('rsvp', [0 => 'Invited', 1 => 'Going', 2 => 'Not Going'], $guest['rsvp'], ['class' => 'invited'] ) !!}</td>
                  <td ng-click="popup{{$guest['guest_list_id']}}=true">N/A</td>
                  <td ng-click="popup{{$guest['guest_list_id']}}=true">{{$guest['name']}}</td>
                  <td>
                    <form id='myform' method='POST' action='#'>
                      <input type='button' value='-' class='qtyminus' field='quantity{{$index}}' />
                      <input type='number' name='quantity{{$index}}' value={{ $guest['additional_guests'] }} class='qty' />
                      <input type='button' value='+' class='qtyplus' field='quantity{{$index}}' />
                    </form>
                  </td>
                  <td ng-click="popup{{$guest['guest_list_id']}}=true" class="responsive-remove">{{$guest['work']}}</td>
                  <td ng-click="popup{{$guest['guest_list_id']}}=true" class="responsive-remove">{{$guest['note']}}</td>
                </tr>
              
          <!--{{$index++}}-->        
          @endforeach
        @else           
            @if( $event['event_status']  == 1)<!--CheckedIn-->
                @foreach($guestList as $guest)
                  @if($guest['rsvp'] == 1)                  
                    <tr>
                      <td>{!! Form::select('rsvp', [0 => 'Check In', 1 => 'Checked In'], $guest['rsvp'], ['class' => 'checkin'] ) !!}</td>
                      <td ng-click="popup{{$guest['guest_list_id']}}=true">N/A</td>
                      <td ng-click="popup{{$guest['guest_list_id']}}=true">{{$guest['name']}}</td>
                      <td>
                        <form id='myform' method='POST' action='#'>
                          <input type='button' value='-' class='qtyminus' field='quantity{{$index}}' />
                          <input type='number' name='quantity{{$index}}' value={{ $guest['additional_guests'] }} class='qty' />
                          <input type='button' value='+' class='qtyplus' field='quantity{{$index}}' />
                        </form>
                      </td>
                      <td ng-click="popup{{$guest['guest_list_id']}}=true" class="responsive-remove">{{$guest['work']}}</td>
                      <td ng-click="popup{{$guest['guest_list_id']}}=true" class="responsive-remove">{{$guest['note']}}</td>
                    </tr>                  
                  @endif
                <!--{{$index++}}-->        
                @endforeach
              @else <!--$event['event_status']  == 2 -->
                @foreach($guestList as $guest)
                  <tr>
                    @if($guest['checked_in_by'] != null)
                      <td>Attended</td>
                    @else
                        @if($guest['rsvp']==1)
                          <td>No Show</td>
                        @else
                          <td>Did Not Attend</td>
                        @endif
                    @endif
                    <td ng-click="popup{{$guest['guest_list_id']}}=true">N/A</td>
                    <td ng-click="popup{{$guest['guest_list_id']}}=true">{{$guest['name']}}</td>                   
                    <td ng-click="popup{{$guest['guest_list_id']}}=true" class="responsive-remove">{{$guest['work']}}</td>
                    <td ng-click="popup{{$guest['guest_list_id']}}=true" class="responsive-remove">{{$guest['note']}}</td>
                  </tr>
                <!--{{$index++}}-->        
                @endforeach
              @endif
        @endif
      </table>

    @foreach($guestList as $guest)
            <div class="popup ng-hide" style="display: block;" ng-show="popup{{$guest['guest_list_id']}}">
              <div class="popup-mask">
                <div class="panel">
                  <div class="panel-inner">
                    <div class="popup-cancel">
                      <a href="#" ng-click="popup{{$guest['guest_list_id']}}=false;"><i class="fa fa-fw fa-times"></i></a>
                    </div>

                    <div class="edit-events container">

                      <h2>Edit Information for {{$guest['contact']['first_name'] . " " . $guest['contact']['last_name']}}</h2>
            
                      {!! Form::model($guest['contact'], ['method' => 'PATCH', 'action' => ['ContactController@update', $guest['contact']['contact_id']],'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
                        @include('contactFolder._contactForm', ['submitButtonText' => 'Edit Contact'])
                      {!! Form::close() !!}        
                    </div>

                  </div>
                </div>
              </div>
            </div>
    @endforeach

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
                // This function shows and hides contact's details .
        $i = 0;        
        $(".showDetails1").click(function(e) {
          if(($i++)%2 == 0 ){               
            document.getElementById("showDetails").style.display = 'inline';                     
          }else{
            document.getElementById("showDetails").style.display = 'none';
          }                
        });

        $(".showDetails").click(function(e){
          $("#showDetails").slideToggle("fast");
        });
    });
    </script>
  </div>
@endsection