@extends('layouts.app')
@section('content')
<div class="edit-events">
    <div class="container">
    	<h1>Edit Event</h1>


        {!! Form::open(array('action' => array('EventController@update', $event->event_id),'class' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}

            <div class="form-group">
                {!! Form::label('event_name', 'Event Name: ') !!}
                {!! Form::text('event_name', $event->event_name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('event_date', 'Date: ') !!}
                {!! Form::text('event_date', $event->event_date, ['class' => 'form-control']) !!}
            </div>   
            <div class="form-group">
                {!! Form::label('event_time', 'Time: ') !!}
                {!! Form::text('event_time', $event->event_time, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('event_location', 'Location: ') !!}
                {!! Form::text('event_location', $event->event_location, ['class' => 'form-control']) !!}
            </div>     
            <div>
                {!! Form::label('event_description', 'Description: ') !!}
                {!! Form::textarea('event_description', $event->event_description, ['class' => 'form-control']) !!}
            </div>
            <div>
                {!! Form::label('num_of_tables','Number of Tables: ') !!}
                {!! Form::text('num_of_tables', $event->num_of_tables, ['class' => 'form-control']) !!}
            </div>
            <div>
                {!! Form::label('seats_per_table','Seats per Table: ') !!}
                {!! Form::text('seats_per_table', $event->seats_per_table, ['class' => 'form-control']) !!}
            </div>        
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div> 
        </div>       
</div>
@endsection