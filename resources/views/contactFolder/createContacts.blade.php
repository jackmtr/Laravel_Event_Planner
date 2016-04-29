@extends('layouts.app')
@section('content')
<div class="create-contacts">
    <div class="container">
        <h1>Create Contact</h1>

        {!! Form::open(['url' => 'contacts', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}

            @include('contactFolder._contactForm', ['submitButtonText' => 'Create Contact'])

        {!! Form::close() !!}

        @include('errors._list')
    </div>
</div>

@endsection