@extends('layouts.app')
@section('content')
<div class="create-contacts">
    <div class="container">
        <h1>Create Contact</h1>

        {!! Form::open(array('url' => 'contacts/create', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}
            <div class="form-group">
                {!! Form::label('first_name', 'First Name: ') !!}
                {!! Form::text('first_name', "", ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('last_name', 'Last Name: ') !!}
                {!! Form::text('last_name', "", ['class' => 'form-control']) !!}
            </div>   
            <div class="form-group">
                {!! Form::label('email', 'Email: ') !!}
                {!! Form::text('email', "", ['class' => 'form-control']) !!}
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
                {!! Form::label('wechat_id', 'Phone Number: ') !!}
                {!! Form::text('wechat_id', "", ['class' => 'form-control']) !!}
            </div>                  
            <div class="form-group">
                {!! Form::label('notes', 'Notes: ') !!}
                {!! Form::textarea('notes', "", ['class' => 'form-control']) !!}
            </div>                        
            <div class="form-group">
                {!! Form::submit('Create Event', ['class' => 'btn btn-primary form-control']) !!}
            </div>                
    </div>
</div>

@endsection