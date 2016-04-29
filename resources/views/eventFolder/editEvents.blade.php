@extends('layouts.app')

@section('content')

<div class="edit-events">
    <div class="container">
    	<h2>Edit Event {!! $event->event_name !!}</h2>

            {!! Form::model($event, ['method' => 'PATCH', 'action' => ['EventController@update', $event->event_id],'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
                @include('eventFolder._eventForm', ['submitButtonText' => 'Edit Event'])
            {!! Form::close() !!}

            {!! Form::open(['method' => 'DELETE', 'url' => 'events/' . $event->event_id]) !!}

				<div class="form-group">
				    {!! Form::submit("Delete Event", ['class' => 'btn btn-primary form-control']) !!}
				</div> 

            {!! Form::close() !!}

            @include('errors._list') 
    </div>       
</div>
@endsection
