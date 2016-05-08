@extends('layouts.app')
@section('content')

<div class="container" ng-app="">

  <div class="subnav">

    <div class="leftside">
      <h3>Event Name</h3>
      <h2>
        {{ $event['event_name'] }}<span><a href="#" class="showDetails">show details</a></span>
      </h2>
    </div>

    <div id="showDetails" class="middleside popup-form" hidden>
      <h2>Edit Event {!! $event->event_name !!}</h2>

        {!! Form::model($event, ['method' => 'PATCH', 'action' => ['EventController@update', $event->event_id],'class' => 'form' ]) !!}

          @include('eventFolder._eventForm', ['submitButtonText' => 'Edit Event', 'eventDate' => null, 'eventTime' => null])

        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'url' => 'events/' . $event->event_id, 'class' => 'form']) !!}
          {!! Form::submit("Delete Event", ['class' => 'btn btn-primary form-control']) !!}
        {!! Form::close() !!}

        @include('errors._list')
    </div>

    <div class="rightside">
      <div class="eventStatus">
        {!! Form::label('event_status', 'Event Status:' )!!}
        {!! Form::select('event_status', [0 => 'OPEN', 1 => 'CHECK-IN', 2 => 'COMPLETED'], $event['event_status'], ['class' => 'openmode ajaxSelect'] ) !!}
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
      {!! Form::open(['action' => ['EventController@show', $event->event_id], 'method' => 'get']) !!}
        {!! Form::text("searchitem", $query, ['placeholder'=>'First or Last Name']) !!}
        {!! Form::submit("Search Guestlist") !!}
      {!! Form::close() !!}
    </div>

    <div id="invitePrevious">
      {!! Form::open(['action' => ['EventController@invitePreviousGuests', $event->event_id], 'novalidate' => 'novalidate', 'name'=>'previous_guests_submit']) !!}

        <label for="events">Invite Guests from a Previous Event: </label>
        <select id="inviteEventSelect" name="events">
          @foreach($events as $pastEvent)
            <option value="{{$pastEvent['event_id']}}">{{$pastEvent['event_name']}}</option>
          @endforeach
        </select>
        <input type="submit" name="guest_list_submit" value="Invite"/>

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

      @if( $event['event_status']  == 0)

        @foreach($guestList as $guest)

          @include('eventFolder._eventTableRows', ['status' => 0])
          <!--{{$index++}}-->

        @endforeach

        @if($comeFromSearch)

          @foreach($contactList as $guest)
            @include('eventFolder._eventTableRows', ['status' => 3])
          @endforeach
          <tr>
            <td colspan="6"><a href="#">Contact not in system?  Create him now!</a></td>
          </tr>        

        @endif

      @else

        @if( $event['event_status']  == 1)

          @foreach($guestList as $guest)

            @if($guest['rsvp'] == 1)
              @if($guest['checked_in_by'] == null){{--*/ $checkStatus = 0 /*--}}@else{{--*/ $checkStatus = 1 /*--}}@endif

              @include('eventFolder._eventTableRows', ['status' => 1])

            @endif
            <!--{{$index++}}-->
          @endforeach

          @if($comeFromSearch)

            @foreach($contactList as $guest)

              @include('eventFolder._eventTableRows', ['status' => 3])

            @endforeach
            <tr>
              <td colspan="6"><a href="#">Contact not in system?  Create him now!</a></td>
            </tr>        
            
          @endif        

          @else <!--$event['event_status']  == 2 -->
            @foreach($guestList as $guest)
              @include('eventFolder._eventTableRows', ['status' => 2])
              <!--{{$index++}}-->
            @endforeach
          @endif

      @endif

    </table>

  </div>

  @foreach($guestList as $guest)
    <div class="popup ng-hide" style="display: block;" ng-show="popup{{$guest['contact']['contact_id']}}">
      <div class="popup-mask">
        <div class="panel">
          <div class="panel-inner">
            <div class="popup-cancel">
              <a href="#" ng-click="popup{{$guest['contact']['contact_id']}}=false;"><i class="fa fa-fw fa-times"></i></a>
            </div>

            <div class="edit-events container">

              <h2>Edit Information for {{$guest['contact']['first_name'] . " " . $guest['contact']['last_name']}}</h2>


              {!! Form::model($guest['contact'], ['method' => 'PATCH', 'action' => ['ContactController@update', $guest['contact']['contact_id']],'class' => 'form']) !!}

                  {!! Form::hidden('event_id', $event->event_id) !!}

                  @include('contactFolder._contactForm', ['submitButtonText' => 'Update Contact', 'edit' => true, 'object' => $guest['contact']])

              {!! Form::close() !!}


            </div>
          </div>
        </div>
      </div>
    </div>
  @endforeach

  @foreach($contactList as $guest)

    <div class="popup ng-hide" style="display: block;" ng-show="popup{{$guest['contact']['contact_id']}}">
      <div class="popup-mask">
        <div class="panel">
          <div class="panel-inner">
            <div class="popup-cancel">
              <a href="#" ng-click="popup{{$guest['contact']['contact_id']}}=false;"><i class="fa fa-fw fa-times"></i></a>
            </div>

            <div class="edit-events container">

              <h2>Edit Information for {{$guest['contact']['first_name'] . " " . $guest['contact']['last_name']}}</h2>

              {!! Form::model($guest['contact'], ['method' => 'PATCH', 'action' => ['ContactController@update', $guest['contact']['contact_id']],'class' => 'form']) !!}

                {!! Form::hidden('event_id', $event->event_id) !!}

                @include('contactFolder._contactForm', ['submitButtonText' => 'Update Contact', 'edit' => true, 'object' => $guest['contact']])

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

    var max_fields = 10; //maximum input boxes allowed
    var index = {{$phoneindex}};

    $.ajaxSetup({
      headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });    

    $(".showDetails").click(function(e){
      $("#showDetails").slideToggle("fast");
    });

    // This button will increment the additional_guests value
    $('.qtyplus').click(function(e){
      e.preventDefault();
      fieldName = $(this).attr('field');
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

    // This button will decrement the additional_guests value till 0
    $(".qtyminus").click(function(e) {
      e.preventDefault();
      fieldName = $(this).attr('field');
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

    // This function changes the additional_guests value in the db
    $(".qtybtn").click(function(){
      var data = $(this).siblings(".qty").val();
      var action = '/guestlist/addguests';
      var request = { theGuest : this.name , theEvent : {{$event['event_id']}}, guests : data };
      $.post(action, request, function (response) {
        if (response) {
          // flash Success message
        } else {
          //something went wrong
        }
      });
    });

    // This function changes the rsvp checked in and event status
    $(".ajaxSelect").change(function () {
      var data = $(this).children(":selected").html();
      if(data == "Invited" || data == "Going" || data == "Not Going" || data == "Remove Guest"){
        var action = '/guestlist/update';
        var request = { theGuest : this.id , theRsvp : data };
      } else if(data == "Not Checked In" || data == "Checked In"){
        var action = '/guestlist/checkin';
        var request = { theGuest : this.id, theCheckin : data };
      } else {
        var action = '/events/togglestatus';
        var request = { theEvent : {{$event['event_id']}} , theStatus : data };
      }
      $.post(action, request, function (response) {
        if (response == "Guest Removed" || "Status Changed") {
          // flash Success message
          location.reload();
        } else if (response) {
          // flash Success message
        } else {
          //something went wrong
        }
      });
    });

    $(".add_phone").click(function(e){
      if(index < max_fields)
      {
        $(".new-phone-numbers").append("<div class='form-group'><label for='phone_number" + index +"'>Additional Phone Number: </label><input class='form-control' name='phonegroup[]" + index +"' type='text' value='' id='phone_number" + index + "'><a href='#' class='remove_field'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></div>");
        index++;
      }

    });

    $(".delete-phone-numbers", $(this)).on("click",".remove_field", function(e)
    { //user click on remove text
      e.preventDefault(); $(this).parent('div').remove(); index--;
    }); //end of remove field
  });

  </script>

@endsection
