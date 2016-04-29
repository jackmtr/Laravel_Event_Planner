@extends('layouts.app')
@section('content')

<div class="edit-events">
    <div class="container">
        <h2>Edit Information for {!! $contact->first_name . " " . $contact->last_name !!}</h2>

        {!! Form::model($contact, ['method' => 'PATCH', 'action' => ['ContactController@update', $contact->contact_id],'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}

            @include('contactFolder._contactForm', ['submitButtonText' => 'Edit Contact'])

        {!! Form::close() !!}

        @include('errors._list')            
        </div>       
</div>
@endsection