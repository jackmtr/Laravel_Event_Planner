@extends('layouts.app')

@section('content')
<div class="contacts">

	<div class="contactheadings">
		<h2>Contacts</h2>
		<a href="{{ url('/contacts/create') }}">Add Contact</a>
	</div>
	
	{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
		{!! Form::text("searchitem", "", ['placeholder'=>'First or Last Name']) !!}
		{!! Form::submit("Search") !!}
	{!! Form::close() !!}

	{{Form::open(array('action' => 'GuestListController@store', 'method' => 'post', 'name'=>'guest_list_submit'))}}
	<table>
		<tr>
			<th>CheckBox</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Phone Number</th>
			<th>Occupation</th>
			<th>Company</th>
			<th>Notes</th>
			<th>Added By</th>
		</tr>
		
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
					<td>{{$contact['email']}}</td>
					<td>{{$contact['display_phoneNumber']}}</td>
					<td>{{$contact['occupation']}}</td>
					<td>{{$contact['company']}}</td>
					<td>{{$contact['notes']}}</td>
					<td>{{$contact['added_by']}}</td>
				</tr>
			@endforeach
		@else
				<p>No Contacts Exist</p>
		@endif

	</table>
	<label for="events">Select an Event: </label>
	<select id="events" name="events">
		@foreach($events_active_open as $event)
			<option value="{{$event['event_id']}}">{{$event['event_name']}}</option>
		@endforeach
	</select>
	<input type="submit" name="guest_list_submit" value="Invite">
	{{Form::close()}}

	<h3>Total Contacts: {{count($contacts)}}</h3>
	<div class="pagination"> {{$contacts->links()}} </div>

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