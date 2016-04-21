@extends('layouts.app')

@section('content')
<h1>
    <div>
        <h1>Active Events</h1>
        <a href="{{ url('/events/create') }}"> (icon) Add Event</a>
        <h4>Table with clickable open/checkin events</h4>
    </div>
    <div>
        <h1>Ended Events</h1>
        <h4>Table with clickable completed events</h4>
    </div>
</h1>
@endsection
