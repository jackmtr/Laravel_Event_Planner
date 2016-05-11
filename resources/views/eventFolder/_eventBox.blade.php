<div class="event-box col col-md-12 col-lg-6 section-business-col">
	<div class="box-left-side">
		<a href="/events/{{$event['event']->event_id}}" >
			<p>{{ date('M j, Y', strtotime($event['event']->event_date)) }}</p>
			<p>{{$event['event']->event_name}}</p>
			<p><span>{{$event['event']->event_location}}</span></p>
		</a>
	</div>

	<div class="box-right-side {{$eventStatus}}-event">
		<div class="{{$eventStatus}}">
			<p>{{$event['count']}}</p>
			<p>{{$eventStatusTitle}}</p>
		</div>
		<div class="duplicate">
			<a href="/events/{{$event['event']->event_id}}/duplicate">Duplicate</a>
		</div>
	</div>
</div>

