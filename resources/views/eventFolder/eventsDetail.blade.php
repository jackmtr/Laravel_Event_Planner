@extends('layouts.app')
@section('content')
<div class="container" ng-app="">
  <div id="ajax">

  </div>
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
      <input type="text" name="s" class="contact-searchbar search rounded" placeholder="Look up names or contact info" /><button><i class="fa fa-search" aria-hidden="true"></i></button>
    </div>
    <div id="invitePrevious">
      {!! Form::open(['action' => ['EventController@show', $event->event_id], 'novalidate' => 'novalidate', 'files' => true, 'name'=>'previous_guests_submit']) !!}
      <label for="events">Invite Guests from a Previous Event: </label>
      <select id="inviteEventSelect" name="events" />
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
      <td>{!! Form::select('rsvp', [0 => 'Invited', 1 => 'Going', 2 => 'Not Going', 3 => 'Remove Guest'], $guest['rsvp'], ['class' => 'invited ajaxSelect', 'id' => $guest['guest_list_id'] ] ) !!}</td>
      <td ng-click="popup{{$guest['guest_list_id']}}=true">N/A</td>
      <td ng-click="popup{{$guest['guest_list_id']}}=true">{{$guest['name']}}</td>
      <td>
        <form id='myform' method='POST' action='#'>
          <input name="{{ $guest['guest_list_id'] }}" type='button' value='-' class='qtyminus qtybtn' field='quantity{{$index}}' />
          <input type='number' name='quantity{{$index}}' value="{{ $guest['additional_guests'] }}" class='qty' />
          <input name="{{ $guest['guest_list_id'] }}" type='button' value='+' class='qtyplus qtybtn' field='quantity{{$index}}' />
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
    @if($guest['checked_in_by'] == null){{--*/ $checkStatus = 0 /*--}}@else{{--*/ $checkStatus = 1 /*--}}@endif
    <tr>
      <td>{!! Form::select('rsvp', [0 => 'Not Checked In', 1 => 'Checked In'], $checkStatus, ['class' => 'checkin ajaxSelect', 'id' => $guest['guest_list_id'] ] ) !!}</td>
      <td ng-click="popup{{$guest['guest_list_id']}}=true">N/A</td>
      <td ng-click="popup{{$guest['guest_list_id']}}=true">{{$guest['name']}}</td>
      <td>
        <form id='myform' method='POST' action='#'>
          <input name="{{ $guest['guest_list_id'] }}" type='button' value='-' class='qtyminus qtybtn' field='quantity{{$index}}' />
          <input type='number' name='quantity{{$index}}' value="{{ $guest['additional_guests'] }}" class='qty' />
          <input name="{{ $guest['guest_list_id'] }}" type='button' value='+' class='qtyplus qtybtn' field='quantity{{$index}}' />
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
</div>

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
  
            {!! Form::model($guest['contact'], ['method' => 'PATCH', 'action' => ['ContactController@update', $guest['contact']['contact_id']],'class' => 'form']) !!}

              {!! Form::hidden('event_id', $event->event_id) !!}

              <div class="form-group">
                  {!! Form::label('first_name', 'First Name: ') !!}
                  {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
              </div>
              <br/>
              <div class="form-group">
                  {!! Form::label('last_name', 'Last Name: ') !!}
                  {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
              </div>   
              <br/>
              <div class="form-group">
                  {!! Form::label('email', 'Email: ') !!}                
                  {!! Form::text('email', null, ['class' => 'form-control']) !!}
              </div>
              <br/>
              <div class="form-group">
                  {!! Form::label('occupation', 'Occupation: ') !!}
                  {!! Form::text('occupation', null, ['class' => 'form-control']) !!}
              </div>   
              <br/>
              <div class="form-group">
                  {!! Form::label('company', 'Company: ') !!}
                  {!! Form::text('company', null, ['class' => 'form-control']) !!}
              </div>
              <br/>
              
              @forelse($guest['contact']['phoneNumber'] as $i => $phonenumber)
                <div class="form-group delete-phone-numbers">
                  {!! Form::label('phone_number'. ($i+1), 'Phone Number ' . ($i+1) . ':') !!}
                  {!! Form::text('phone_number' . ($i+1), $phonenumber['phone_number'], ['class' => 'form-control', 'name' => 'phonegroup[]']) !!}
                    @if($i != 0)
                      <a href='#' class='remove_field'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a>
                    @endif
                </div>  
                <!--{{$phoneindex++}}-->  
              @empty
                <div class="form-group">
                    {!! Form::label('phone_number', 'Phone Number 1: ') !!}
                    {!! Form::text('phone_number', null, ['class' => 'form-control', 'name' => 'phonegroup[]']) !!}            
                </div>                          
              @endforelse
              

              <!-- new phone inputs come here -->
              <div class="new-phone-numbers delete-phone-numbers"></div>

              <a href="#" class="add_phone"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

              <div class="form-group">
                  {!! Form::label('wechat_id', 'Wechat Id: ') !!}
                  {!! Form::text('wechat_id', null, ['class' => 'form-control']) !!}
              </div>          
              <br/>        
              <div class="form-group">
                  {!! Form::label('notes', 'Notes: ') !!}
                  {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
              </div>             
              <br/>           
              <div class="form-group">
                  {!! Form::submit("Edit contact", ['class' => 'btn btn-primary form-control']) !!}
              </div>   

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
  $.ajaxSetup({
    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
  });
  </script>

  <script>

  $(document).ready(function(){

        var max_fields = 10; //maximum input boxes allowed
        var index = {{$phoneindex}};

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

        $(".qtybtn").click(function(){
          var data = $(this).siblings(".qty").val();
          var action = '/guestlist/addguests';
          var request = { theGuest : this.name , theEvent : {{$event['event_id']}}, guests : data };
          $.post(action, request, function (response) {
            if (response) {
              $('#ajax').html(response); // flash Success message
              location.reload();
            } else {
              $('#ajax').html(response);
            }
          });
        });        

        $(".showDetails").click(function(e){
          $("#showDetails").slideToggle("fast");
        });
    
            // This function changes the rsvp status
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
            if (response) {
              $('#ajax').html(response); // flash Success message
              location.reload();
            } else {
              $('#ajax').html(response);
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
