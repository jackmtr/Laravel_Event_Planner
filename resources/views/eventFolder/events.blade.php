@extends('layouts.app')

@section('content')

<div class="event"> <!--used to flex down column-->
	<div class="top-event-color"> <!--used to bg-color outside container-->
		<div class="container">
			<div class="subnav">
				<h2>Active Events</h2>
				<a href="{{ url('/events/create') }}">[ + ] Add Event</a>
			</div>
			@foreach($eventsWithCount as $openEvent)
				@if($openEvent['event']->event_status != 2)
					<div class="event-box col col-md-12 col-lg-6 section-business-col">
						<div class="box-left-side">
							<a href="/events/{{$openEvent['event']->event_id}}" >
								<p>{{ date('M j, Y', strtotime($openEvent['event']->event_date)) }}</p>
								<p>{{$openEvent['event']->event_name}}</p>
								<p><span>{{$openEvent['event']->event_location}}</span></p>
							</a>
						</div>

						@if($openEvent['event']->event_status == 0)
						<div class="box-right-side" style="background-color: #1e8f98">
							<div class="checkedin">
								<p>{{$openEvent['count']}}</p>
								<p>Invited</p>
							</div>
							<div class="duplicate">
								<a href="/events/{{$openEvent['event']->event_id}}/duplicate">Duplicate</a>
							</div>
						</div>

						@elseif($openEvent['event']->event_status == 1)
						<div class="box-right-side">
							<div class="checkedin">
								<p>{{$openEvent['count']}}</p>
								<p>Checked in</p>
							</div>
							<div class="duplicate">
								<a href="/events/{{$openEvent['event']->event_id}}/duplicate">Duplicate</a>
							</div>
						</div>
						@endif
					</div>
				@endif
			@endforeach
		</div>
	</div>

	<div class="bottom-event-color">
		<div class="container">
			<div class="subnav">
				<h2>Ended Events</h2>
			</div>
			@foreach($eventsWithCount as $closedEvent)
			@if($closedEvent['event']->event_status == 2)
			<div class="event-box col col-md-12 col-lg-6 section-business-col">
				<div class="box-left-side">
					<a class="singleeventleftbox" href="/events/{{$closedEvent['event']->event_id}}">
						<p>{{$closedEvent['event']->event_date}}</p>
						<p>{{$closedEvent['event']->event_name}}</p>
						<p><span>{{$closedEvent['event']->event_location}}</span></p>
					</a>
				</div>
				<div class="box-right-side" style="background-color: #eaeaea">
					<div class="checkedin">
						<p>{{$closedEvent['count']}}</p>
						<p>Went</p>
					</div>
					<div class="duplicate">
						<a href="/events/{{$closedEvent['event']->event_id}}/duplicate">Duplicate</a>
					</div>
				</div>
			</div>
			@endif
			@endforeach
		</div>
	</div>
</div>
@endsection