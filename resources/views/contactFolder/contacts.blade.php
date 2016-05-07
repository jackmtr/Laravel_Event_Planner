@extends('layouts.app')

@section('content')
<div class="contacts container" ng-app="">
	<div class="subnav">
		<h2>Contacts</h2>

		<a href="{{ url('/contacts/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Contact</a>
		{!! Form::open(['action' => 'CSVController@importContacts', 'method' => 'POST', 'novalidate' => 'novalidate', 'files' => true]) !!}
			{!! Form::file('csvContacts') !!}
			{!! Form::submit("Import Contacts") !!}
		{!! Form::close() !!}
		<a href="{{url('/export/contacts') }}"><i class="fa fa-download" aria-hidden="true"></i> Export Contacts</a>
	</div>

	<div class="contact-nav-bar">
		{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
			{!! Form::text("searchitem", "", ['placeholder'=>'First or Last Name']) !!}
			{!! Form::submit("Search Contacts") !!}
		{!! Form::close() !!}

		<table class="sg-table">
			<tr>
				<th>CheckBox</th>
				<th>
					{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
						{!! Form::hidden("sortby", "first_name") !!}
						{!! Form::submit("First Name") !!}
					{!! Form::close() !!}
				</th>
				<th>
					{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
						{!! Form::hidden("sortby", "last_name") !!}
						{!! Form::submit("Last Name") !!}
					{!! Form::close() !!}
				</th>
				<th class="responsive-minimum">Email</th>
				<th class="responsive-minimum">Phone Number</th>
				<th class="responsive-remove">Occupation</th>
				<th>
					{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
						{!! Form::hidden("sortby", "company") !!}
						{!! Form::submit("Company") !!}
					{!! Form::close() !!}
				</th>
				<th class="responsive-remove">Notes</th>
				<th class="responsive-remove">Added By</th>
			</tr>
			{{Form::open(array('action' => 'GuestListController@store', 'method' => 'post', 'name'=>'guest_list_submit'))}}

			<div class="search-event">
				<label for="events">Select an Event: </label>
				<select id="events" name="events">
					@foreach($events_active_open as $event)
						<option value="{{$event['event_id']}}">{{$event['event_name']}}</option>
					@endforeach
				</select>
				<input type="submit" name="guest_list_submit" value="Invite" />
			</div>

			@if (count($contacts) > 0)
				@foreach($contacts as $contact)
					<tr>
						<td class='cellcheckbox'>
							{!! Form::label("invitelist[]", " ", array('class' => 'label-checkbox')) !!}
							{{ Form::checkbox('invitelist[]', $contact['contact_id'], false, ['id' => 'invitecheckbox'.$contact["contact_id"]]) }}
							<span></span>
						</td>
						<td ng-click="popup{{$contact['contact_id']}}=true">{{$contact['first_name']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true">{{$contact['last_name']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true" class="responsive-minimum">{{$contact['email']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true" class="responsive-minimum">{{$contact['display_phoneNumber']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true" class="responsive-remove">{{$contact['occupation']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true">{{$contact['company']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true" class="responsive-remove">{{$contact['notes']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true" class="responsive-remove">{{$contact['added_by']}}</td>
					</tr>
				@endforeach
			@else
					<p>No Contacts Exist</p>
			@endif
		</table>
		<div class="pagination"> {{$contacts->links()}} </div>
		{{Form::close()}}
	</div>

@foreach($contacts as $contact)
<div class="popup ng-hide" style="display: block;" ng-show="popup{{$contact['contact_id']}}">
  <div class="popup-mask">
    <div class="panel">
      <div class="panel-inner">
        <div class="popup-cancel">
          <a href="#" ng-click="popup{{$contact['contact_id']}}=false;"><i class="fa fa-fw fa-times"></i></a>
        </div>

        <div class="edit-events container">

			<h2>Edit Information for {{$contact['first_name'] . " " . $contact['last_name']}}</h2>

			{!! Form::model($contact, ['method' => 'PATCH', 'action' => ['ContactController@update', $contact['contact_id']],'class' => 'form']) !!}

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

				@forelse($contact['phoneNumber'] as $i => $phonenumber)
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

			<h2>Previously Attended Events</h2>
			<ul>
				@foreach($contact['previous_event'] as $previousEvent)
					<li>{{$previousEvent}}</li>
				@endforeach
			</ul>
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

			$('.cellcheckbox').on('click', 'span', function(){
				var checkbox = $(this).parent().find("input");
				checkbox.prop("checked", !checkbox.prop("checked"));
			});

			$(".add_phone").click(function(e){
				if(index < max_fields)
				{
				  $(".new-phone-numbers").append("<div class='form-group'><label for='phone_number" + index +"'>Additional Phone Number: </label><input class='form-control' name='phonegroup[]" + index +"' type='text' value='' id='phone_number" + index + "'><a href='#' class='remove_field'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a></div>");
				  index++;
				}

			});

			$(".delete-phone-numbers", $(this)).on("click",".remove_field", function(e){ //user click on remove text
				e.preventDefault(); $(this).parent('div').remove(); index--;
			}); //end of remove field			

		});
	</script>
@endsection
