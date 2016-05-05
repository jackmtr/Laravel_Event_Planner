@extends('layouts.app')
@section('content')

<div class="edit-events container">
        <h2>Edit Information for {!! $contact->first_name . " " . $contact->last_name !!}</h2>

        {!! Form::model($contact, ['method' => 'PATCH', 'action' => ['ContactController@update', $contact->contact_id],'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}

            @include('contactFolder._contactForm', ['submitButtonText' => 'Edit Contact'])

        {!! Form::close() !!}

        {!! Form::open(['method' => 'DELETE', 'url' => 'contacts/' . $contact->contact_id]) !!}

			<div class="form-group">
			    {!! Form::submit("Delete Contact", ['class' => 'btn btn-primary form-control']) !!}
			</div> 

        {!! Form::close() !!}

        @include('errors._list')               
</div>
@endsection