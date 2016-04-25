@extends('layouts.app')

@section('content')
<div class="contacts">

	<div class="contactheadings">
		<h2>Contacts</h2>
		<h3>Amount of Contacts: {{count($contacts)}}</h3>
		<a href="{{ url('/contacts/create') }}">Add Contact</a>
	</div>

	<table>
		<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Occupation</th><th>Company</th><th>Notes</th><th>Added By</th></tr>
		
		@if (count($contacts))
			@foreach($contacts as $contact)
				<tr>
					<td>{{$contact['first_name']}}</td>
					<td>{{$contact['last_name']}}</td>
					<td>{{$contact['email']}}</td>
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
</div>
@endsection