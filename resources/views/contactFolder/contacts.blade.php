@extends('layouts.app')

@section('content')
<div>
<a href="{{ url('/contacts/create') }}">Add Contact</a>
<table>
<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Occupation</th><th>Company</th><th>Notes</th><th>Added By</th></tr>
{{count($contacts)}}
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