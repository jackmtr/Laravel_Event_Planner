@extends('layouts.app')
@section('content')
	<h1>Create Contact</h1>

    {!! Form::open(array('url' => 'contacts/create', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}
        <div class="form-group">
            {!! Form::label('firstName', 'First Name: ') !!}
            {!! Form::text('firstName', "", ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('lastName', 'Last Name: ') !!}
            {!! Form::text('lastName', "", ['class' => 'form-control']) !!}
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