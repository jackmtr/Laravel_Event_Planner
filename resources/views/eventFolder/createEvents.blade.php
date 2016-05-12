@extends('layouts.app')
@section('content')
<div class="form container">
	<h1>Create Event</h1>
	{!! Form::open(['url' => 'events', 'class' => 'form', 'id' => 'eventForm']) !!}

		@include('eventFolder._eventForm', ['submitButtonText' => 'Create Event', 'eventDate' => date('Y-m-d'), 'eventTime' => '18:00:00', 'eventEndTime' => '21:00:00' ])

	{!! Form::close() !!}

	@include('errors._list')
</div>
@endsection

@section('javascript')
	<script>
		$('#eventForm').validate();
	</script>
@endsection
