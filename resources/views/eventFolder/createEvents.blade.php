@extends('layouts.app')
@section('content')
<div class="form container">
	<h1>Create Event</h1>
	{!! Form::open(['url' => 'events', 'class' => 'inputform', 'id' => 'eventCreateForm']) !!}

		@include('eventFolder._eventForm', ['submitButtonText' => 'Create Event', 'eventDate' => date('Y-m-d'), 'eventTime' => '18:00', 'eventEndTime' => '21:00' ])
		
	{!! Form::close() !!}

	@include('errors._list')
</div>
@endsection

@section('javascript')
	<script>
		$(#eventCreateForm).validate({
			errorElement: 'div',
		});
	</script>
@endsection
