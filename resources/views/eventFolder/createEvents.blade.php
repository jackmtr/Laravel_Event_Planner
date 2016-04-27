@extends('layouts.app')
@section('content')
<div class="create-events">
    <div class="container">
    	<h1>Create Event</h1>

        {!! Form::open(['url' => 'events/create', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
            <div class="form-group">
                {!! Form::label('event_name', 'Event Name: ') !!}
                {!! Form::text('event_name', "", ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('event_date', 'Date: ') !!}
                {!! Form::input('date', 'event_date', date('Y-m-d'), ['class' => 'form-control']) !!}
            </div>   
            <div class="form-group">
                {!! Form::label('event_time', 'Time: ') !!}
                {!! Form::input('time', 'event_time', date('h:i'), ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('event_location', 'Location: ') !!}
                {!! Form::text('event_location', "", ['class' => 'form-control']) !!}
            </div>     
            <div>
                {!! Form::label('event_description', 'Description: ') !!}
                {!! Form::textarea('event_description', "", ['class' => 'form-control']) !!}
            </div>
            <div>
                {!! Form::label('num_of_tables','Number of Tables: ') !!}
                {!! Form::text('num_of_tables',"", ['class' => 'form-control']) !!}
            </div>
            <div>
                {!! Form::label('seats_per_table','Seats per Table: ') !!}
                {!! Form::text('seats_per_table',"", ['class' => 'form-control']) !!}
            </div>        
            <div class="form-group">
                {!! Form::submit('Create Event', ['class' => 'btn btn-primary form-control']) !!}
            </div> 
        </div>       
</div>
@endsection