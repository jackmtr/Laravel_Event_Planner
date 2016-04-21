@extends('layouts.app')

@section('content')
<div>
<a href="{{ url('/contacts/create') }}"> (icon) Add Contact</a>

<p>A list of all contacts</p>

<table>
<tr><th>First Name</th><th>Last Name</th><th>Email</th><th>Occupation</th><th>Company</th><th>Notes</th><th>Added By</th></tr>
{{count($contacts)}}
@if (count($contacts))
	@foreach($contacts as $contact)
		<tr>
			<td>{{{$contact['firstName']}}}</td>
			<td>{{{$contact['lastName']}}}</td>
		</tr>
	@endforeach
@else
		<p>No Contacts Exist</p>
@endif
</table>
</div>
@endsection