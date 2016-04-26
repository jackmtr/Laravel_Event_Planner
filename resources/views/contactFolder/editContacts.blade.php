@extends('layouts.app')
@section('content')
<div class="edit-events">
    <div class="container">
        <h1>Edit Event</h1>

        

        {!! Form::open(array('action' => array('ContactController@update', $contact->contact_id),'class' => 'form', 'novalidate' => 'novalidate', 'files' => true)) !!}
            <div class="form-group">
                {!! Form::label('first_name', 'First Name: ') !!}
                {!! Form::text('first_name', $contact->first_name, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('last_name', 'Last Name: ') !!}
                {!! Form::text('last_name', $contact->last_name, ['class' => 'form-control']) !!}
            </div>   
            <div class="form-group">
                {!! Form::label('email', 'Email: ') !!}
                {!! Form::text('email', $contact->email, ['class' => 'form-control']) !!}        
            </div>   
            <div class="form-group">
                {!! Form::label('occupation', 'Occupation: ') !!}
                {!! Form::text('occupation', $contact->occupation, ['class' => 'form-control']) !!}
            </div>   
            <div class="form-group">
                {!! Form::label('company', 'Company: ') !!}
                {!! Form::text('company', $contact->company, ['class' => 'form-control']) !!}
            </div>   
            <div class="form-group">
                {!! Form::label('wechat_id', 'Wechat_id: ') !!}
                {!! Form::text('wechat_id', $contact->wechat_id, ['class' => 'form-control']) !!}
            </div>   
            <div class="form-group">
                {!! Form::label('notes', 'Notes: ') !!}
                {!! Form::text('notes', $contact->notes, ['class' => 'form-control']) !!}
            </div>  
            <div class="form-group">
                {!! Form::label('added_by', 'Added_by: ') !!}
                {!! Form::text('added_by', $contact->added_by, ['class' => 'form-control']) !!}
            </div>               
            
            <div class="form-group">
                {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
            </div> 
        </div>       
</div>
@endsection