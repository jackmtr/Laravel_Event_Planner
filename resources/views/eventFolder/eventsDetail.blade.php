@extends('layouts.app')
@section('content')

<div class="container" ng-app="">

  <div class="subnav">

    <div class="leftside">
      <h3>Event Name</h3>
      <h2>
        {{ $event['event_name'] }} <span><a href="#" class="showDetails">show details</a></span>
      </h2>
    </div>

    <div>
      @include('flash')
      <div id="showDetails" class="middleside popup-form" hidden>
        <h2>Edit Event {!! $event->event_name !!}</h2>


        {!! Form::model($event, ['method' => 'PATCH', 'action' => ['EventController@update', $event->event_id],'class' => 'form', 'id' => 'eventForm' ]) !!}

          @include('eventFolder._eventForm', ['submitButtonText' => 'Edit Event', 'eventDate' => null, 'eventTime' => null, 'eventEndTime' => null])

        {!! Form::close() !!}
        @if( $event['event_status']  != 1)
          <input type="submit" name="button" class="button-default" ng-click="popupdelete = true;" value="Delete Event" />

          <div class="popup ng-hide" style="display: block;" ng-show="popupdelete">
            <div class="popup-mask">
              <div class="panel">
                <div class="panel-inner">
                  <h2>Are you sure you want to delete this event?</h2>

                  {!! Form::open(['method' => 'DELETE', 'url' => 'events/' . $event->event_id, 'class' => 'form']) !!}
                    {!! Form::submit("Delete Event", ['class' => 'btn btn-primary form-control button-default']) !!}
                  {!! Form::close() !!}

                  <p class="link-cancel">
                    <a href="#" ng-click="popupdelete=false;">No, send me back to edits.</a>
                  </p>

                </div>
              </div>
            </div>
          </div>
      </div>
      
      @endif

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
          <h2>{{ $countAllGuests }}</h2>
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
    @if($event['event_status'] == 0)
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
    @endif
    @if($event['event_status'] == 2)
    <a href="{{url("/export/guestlist/{$event['event_id']}") }}"><i class="fa fa-download" aria-hidden="true"></i> Export Contacts</a>
    @endif
  </div>

  <div class="guestList">
    <table class="sg-table">

      <tr>
        <th>Status</th>
        <th>Name</th>
        <th>Guests</th>
        <th class="responsive-remove">Title &amp; Company</th>
        <th class="responsive-remove">Notes</th>
      </tr>


      @if( $event['event_status']  == 0) <!--$event['event_status']  == 0 -->

      @foreach($guestList as $guest)

      @include('eventFolder._eventTableRows', ['status' => 0])
      <!--{{$index++}}-->
      @endforeach

      @if($comeFromSearch)

      @foreach($contactList as $guest)
      @include('eventFolder._eventTableRows', ['status' => 3])
      @endforeach

      <tr>
        <td ng-click="popupNewContact=true" colspan="6"><a href="#">Contact not in system?  Create now!</a></td>
        <div class="popup ng-hide" style="display: block;" ng-show="popupNewContact">
          <div class="popup-mask">
            <div class="panel">
              <div class="panel-inner">
                <div class="popup-cancel">
                  <a href="#" ng-click="popupNewContact=false;"><i class="fa fa-fw fa-times"></i></a>
                </div>
                <div class="edit-events container">

                  <h1>Create Contact</h1>

                  {!! Form::open(['action' => ['GuestListController@createContactGuest'], 'class' => 'form']) !!}

                    {!! Form::hidden('eventId', $event->event_id) !!}

                    @include('contactFolder._contactForm', ['submitButtonText' => 'Create Contact and Invite to Event', 'edit' => false])

                  {!! Form::close() !!}

                  @include('errors._list')

                </div>
              </div>
            </div>
          </div>
        </div>
      </tr>

      @endif

      @else

      @if( $event['event_status']  == 1) <!--$event['event_status']  == 1 -->

      @foreach($guestList as $guest)

      @if($guest['rsvp'] == 1)
      @if($guest['checked_in_by'] != null){{--*/ $checkStatus = 1 /*--}}@else{{--*/ $checkStatus = 0 /*--}}@endif
      @include('eventFolder._eventTableRows', ['status' => 1, 'checkStatus'=>$checkStatus])

      @endif
      <!--{{$index++}}-->
      @endforeach

      @if($comeFromSearch)

      @foreach($contactList as $guest)

      @include('eventFolder._eventTableRows', ['status' => 3])

      @endforeach

      <tr>
        <td colspan="6"><a href="#">Contact not in system?  Create now!</a></td>
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

  @foreach(array_merge($guestList, $contactList) as $guest)
  <div class="popup ng-hide" style="display: block;" ng-show="popup{{$guest['contact']['contact_id']}}">
    <div class="popup-mask">
      <div class="panel">
        <div class="panel-inner">
          <div class="popup-cancel">
            <a href="#" ng-click="popup{{$guest['contact']['contact_id']}}=false;"><i class="fa fa-fw fa-times"></i></a>
          </div>
          <div class="edit-events container">
            <h2>Edit Information for {{$guest['contact']['first_name'] . " " . $guest['contact']['last_name']}}</h2>

            {!! Form::model($guest['contact'], ['method' => 'PATCH', 'action' => ['ContactController@update', $guest['contact']['contact_id']],'class' => 'form', 'id' => 'contactForm']) !!}

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

    $.ajaxSetup({
      headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

    $('#eventForm').validate();
    $('#contactForm').validate();
    $('#guestContactForm').validate();

    @include('javascript._phoneJavascript')

    var event_status = $('.eventStatus').find('option:selected').html();

    if(event_status == "OPEN"){
        $(".openmode").addClass("openstatus");
    }else if(event_status == "CHECK-IN"){
      $(".openmode").addClass("checkedinstatus");
    }else if(event_status == "COMPLETED"){
      $(".openmode").addClass("completedstatus");
    }
    
    $('.status').each(function(){
      var guest_status = $(this).find('option:selected').html();
      if (guest_status == "Invited"){
        $(this).addClass("invitedstatus").removeClass("status");
      }else if(guest_status == "Going"){
        $(this).addClass("goingstatus").removeClass("status");
      }
      else if(guest_status == "Not Going"){
        $(this).addClass("notstatus").removeClass("status");
      }
      else if(guest_status == "Checked In"){
        $(this).addClass("guestcheckedin").removeClass("status");
      }
      else if(guest_status == "Not Checked In"){
        $(this).addClass("guestnotcheckedin").removeClass("status");
      }
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
      var request = { theGuest : this.name, guests : data };
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
      var thisObject = $(this);
      var data = thisObject.children(":selected").html();
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
        if (response == "Guest Removed" || response == "Status Changed") {
          // flash Success message
          location.reload();
        } else if (response) {
          console.log($(thisObject).attr('class').split(' ')[1]);
          $(thisObject).removeClass($(thisObject).attr('class').split(' ')[1]).addClass(response);
        } else {
          //something went wrong
        }
      });
    });
  });
  </script>
@endsection
