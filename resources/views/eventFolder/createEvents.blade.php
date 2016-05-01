@extends('layouts.app')
@section('content')
<!--
- add date picker
- add time picker
-->
<div class="create-events container">
	<h1>Create Event</h1>
	{!! Form::open(['url' => 'events', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
	@include('eventFolder._eventForm', ['submitButtonText' => 'Create Contact'])
	{!! Form::close() !!}

	@include('errors._list')
</div>
@endsection
