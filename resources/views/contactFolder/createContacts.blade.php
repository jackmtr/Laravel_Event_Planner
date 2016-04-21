@extends('layouts.app')
@section('content')
	<h1>Create Contact</h1>

    {!! Form::open(array('url' => 'events', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}
        <div class="form-group">
            {!! Form::label('fname', 'First Name: ') !!}
            {!! Form::text('fname', "", ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('lname', 'Last Name: ') !!}
            {!! Form::text('lname', "", ['class' => 'form-control']) !!}
        </div>   
        <div class="form-group">
            {!! Form::label('email', 'Email: ') !!}
            {!! Form::text('email', "", ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('phone', 'Phone Number: ') !!}
            {!! Form::text('phone', "", ['class' => 'form-control']) !!}
        </div>     
        <div class="form-group">
            {!! Form::label('occupation', 'Occupation: ') !!}
            {!! Form::text('occupation', "", ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('company', 'Company: ') !!}
            {!! Form::text('company', "", ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('notes', 'Notes: ') !!}
            {!! Form::textarea('notes', "", ['class' => 'form-control']) !!}
        </div>                
        <div class="form-group">
            {!! Form::submit('Create Event', ['class' => 'btn btn-primary form-control']) !!}
        </div>        
@endsection