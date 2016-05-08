@extends('layouts.app')

@section('content')

<div class="event"> <!--used to flex down column-->
	<div class="top-event-color"> <!--used to bg-color outside container-->
		<div class="container">
			<div class="subnav">
				<h2>Active Events</h2>
				<a href="{{ url('/events/create') }}"><i class="fa fa-plus" aria-hidden="true"></i> Add Event</a>
			</div>
			@forelse($eventsWithCount as $event)
				@if($event['event']->event_status == 1)
					@include('eventFolder._eventBox', ['eventStatusTitle' => 'Checked In', 'eventStatus' => 'checkedin-event'])
				@elseif($event['event']->event_status == 0)
					@include('eventFolder._eventBox', ['eventStatusTitle' => 'Invited', 'eventStatus' => 'open-event'])
				@endif
			@empty
				<p>You do not have any current events.</p>
			@endforelse
		</div>
	</div>

	<div class="bottom-event-color">
		<div class="container">
			<div class="subnav">
				<h2>Ended Events</h2>
			</div>
			@forelse($eventsWithCount as $event)
				@if($event['event']->event_status == 2)
					@include('eventFolder._eventBox', ['eventStatusTitle' => 'Went', 'eventStatus' => 'completed-event'])
				@endif
			@empty
				<p>You do not have any past events.</p>
			@endforelse
		</div>
	</div>
</div>
@endsection