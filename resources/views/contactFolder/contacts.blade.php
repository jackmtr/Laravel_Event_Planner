@extends('layouts.app')

@section('content')
<div class="contacts container" ng-app="">
	<div class="subnav">
		<h2>Contacts</h2>
		<a href="{{ url('/contacts/create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Contact</a>
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
	</div>

	<div>
		<table class="sg-table">
			<tr>
				<th>Delete</th>
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
					@foreach($open_events as $event)
						<option value="{{$event['event_id']}}">{{$event['event_name']}}</option>
					@endforeach
				</select>
				<input type="submit" name="guest_list_submit" value="Invite" />
			</div>

			@if (count($contacts) > 0)
				@foreach($contacts as $contact)
					<tr>
						<td>
							<button type="button" name="button" class="button-default" ng-click="popupdelete{{$contact['contact_id']}}=true"><i class="fa fa-trash" aria-hidden="true"></i></button>   							    								
						</td>
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
	<div class="popup ng-hide" style="display: block;" ng-show="popupdelete{{$contact['contact_id']}}">
		<div class="popup-mask">
		  <div class="panel">
		    <div class="panel-inner">
		      <h2>Are you sure you want to delete this contact?</h2>

				{!! Form::open(['method' => 'DELETE', 'url' => 'contacts/' . $contact->contact_id]) !!}
					{!! Form::submit("Delete Contact", ['class' => 'btn btn-primary form-control button-default']) !!}
				{!! Form::close() !!}	   

		      <p class="link-cancel">
		        <a href="#" ng-click="popupdelete{{$contact['contact_id']}}=false;">No, take me back.</a>
		      </p>

		    </div>
		  </div>
		</div>
	</div> 

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

							@include('contactFolder._contactForm', ['submitButtonText' => 'Edit Contact', 'edit' => true, 'object' => $contact])

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
	</div>
	@endforeach	
</div>
@endsection

@section('javascript')
	<script>
		$(document).ready(function(){

			@include('javascript._phoneJavascript')	

			$('.cellcheckbox').on('click', 'span', function(){
				var checkbox = $(this).parent().find("input");
				checkbox.prop("checked", !checkbox.prop("checked"));
			});

			
		});
	</script>
@endsection
