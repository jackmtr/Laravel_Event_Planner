@extends('layouts.app')
@section('content')
<!--
- add date picker
- add time picker
-->
<div class="form container">
	<h1>Create Event</h1>
	{!! Form::open(['url' => 'events', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}

		@include('eventFolder._eventForm', ['submitButtonText' => 'Create Event'])
		
	{!! Form::close() !!}

	@include('errors._list')
</div>
@endsection
