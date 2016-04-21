@extends('layouts.app')
@section('content')
	<h1>Create Event</h1>

    {!! Form::open(array('url' => 'events/create', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}
        <div class="form-group">
            {!! Form::label('eventName', 'Event Name: ') !!}
            {!! Form::text('eventName', "", ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('eventDate', 'Date: ') !!}
            {!! Form::text('eventDate', "", ['class' => 'form-control']) !!}
        </div>   
        <div class="form-group">
            {!! Form::label('eventTime', 'Time: ') !!}
            {!! Form::text('eventTime', "", ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('location', 'Location: ') !!}
            {!! Form::text('location', "", ['class' => 'form-control']) !!}
        </div>     
        <div class="form-group">
            {!! Form::submit('Create Event', ['class' => 'btn btn-primary form-control']) !!}
        </div>        
@endsection