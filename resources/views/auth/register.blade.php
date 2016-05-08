@extends('layouts.app')
@section('content')
<div class="form container">
    <h1>Register</h1>

    @include('flash')

    {!! Form::open(['url' => 'register', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => 'true']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name']) !!}
        </div>
        
        <div class="form-group">
            {!! Form::label('email', 'Email Address: ') !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password: ') !!}
            {!! Form::password('password', null, ['class' => 'form-control', 'id' => 'password']) !!}
        </div>           

        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirm Password: ') !!}
            {!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
        </div>  

        <div class="form-group">
            {!! Form::submit("Register New Event Coordinator", ['class' => 'btn btn-primary form-control']) !!}
        </div>           

    {!! Form::close() !!}

    @include('errors._list')


</div>
@endsection
