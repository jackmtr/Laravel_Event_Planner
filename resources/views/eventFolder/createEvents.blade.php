@extends('layouts.app')
@section('content')
	<h1>Create Event</h1>

    {!! Form::open(array('url' => 'events', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}
        <div class="form-group">
            {!! Form::label('eventName', 'Event Name: ') !!}
            {!! Form::text('eventName', "", ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('date', 'Date: ') !!}
            {!! Form::text('date', "", ['class' => 'form-control']) !!}
        </div>   
        <div class="form-group">
            {!! Form::label('time', 'Time: ') !!}
            {!! Form::text('time', "", ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('location', 'Location: ') !!}
            {!! Form::text('location', "", ['class' => 'form-control']) !!}
        </div>     
        <div class="form-group">
            {!! Form::label('description', 'Description: ') !!}
            {!! Form::textarea('description', "", ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Create Event', ['class' => 'btn btn-primary form-control']) !!}
        </div>        
@endsection