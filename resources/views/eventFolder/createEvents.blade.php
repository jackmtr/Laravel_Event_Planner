@extends('layouts.app')
@section('content')
<div class="create-events">
    <div class="container">
    	<h1>Create Event</h1>
            {!! Form::open(['url' => 'events', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
                @include('eventFolder._eventForm', ['submitButtonText' => 'Create Contact'])
            {!! Form::close() !!}

            @include('errors._list')              
            
        </div>       
</div>
@endsection