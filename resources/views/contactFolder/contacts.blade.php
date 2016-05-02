@extends('layouts.app')

@section('content')
<div class="contacts container">
	<div class="subnav">
		<h2>Contacts</h2>
<<<<<<< HEAD
		<a href="{{ url('/contacts/create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Contact</a>
=======
		<a href="{{ url('/contacts/create') }}">[ + ] Add Contact</a>
>>>>>>> 663845e7c845869ed0d2368355ee6193ffd235cd
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
						<td>{{$contact['first_name']}}</td>
						<td>{{$contact['last_name']}}</td>
						<td class="responsive-minimum">{{$contact['email']}}</td>
						<td class="responsive-minimum">{{$contact['display_phoneNumber']}}</td>
						<td class="responsive-remove">{{$contact['occupation']}}</td>
						<td>{{$contact['company']}}</td>
						<td class="responsive-remove">{{$contact['notes']}}</td>
						<td class="responsive-remove">{{$contact['added_by']}}</td>
					</tr>
				@endforeach
			@else
					<p>No Contacts Exist</p>
			@endif
		</table>
		<div class="pagination"> {{$contacts->links()}} </div>	
		{{Form::close()}}
	</div>
</div>
@endsection

@section('javascript')
	<script>
		$(document).ready(function(){
			$('.cellcheckbox').on('click', 'span', function(){
				var checkbox = $(this).parent().find("input");
				checkbox.prop("checked", !checkbox.prop("checked"));
			});
		});
	</script>
@endsection
