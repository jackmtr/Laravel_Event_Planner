@extends('layouts.app')

@section('content')
<div>
  <a href="{{ url('/events/create') }}"> (icon) Add Event</a>
  <h1>Active Events</h1>
  <table>
    <tr><th>Event</th><th>Status</th><th>Date</th><th>Time</th><th>Location</th><th>Description</th><th># of Tables</th><th># Seats per Table</th></tr>
    @if (count($eventsWithCount))
    @foreach($eventsWithCount as $event)
    @if($event['event_status'] == 0)
    <tr>
      <td>{{ $event['event_name'] }}</td>
      <td>OPEN</td>
      <td>{{$event['event_date']}}</td>
      <td>{{$event['event_time']}}</td>
      <td>{{$event['event_location']}}</td>
      <td>{{$event['event_description']}}</td>
      <td>{{$event['num_of_tables']}}</td>
      <td>{{$event['seats_per_table']}}</td>
    </tr>
    @endif
    @endforeach
    @else
    <p>No Contacts Exist</p>
    @endif
  </table>

</div>
<div>
  <h1>Ended Events</h1>
  @foreach($eventsWithCount as $event)
  @if($event['event_status'] == 2)
  <div>
    {{$event['event_date']}}<br />
    {{$event['event_name']}}<br />
    {{$event['event_location']}}
  </div>
  <div>
    {{$event['count']}}
  </div>
  @endif
  @endforeach
</div>
@endsection
