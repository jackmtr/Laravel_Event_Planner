@extends('layouts.app')
@section('content')
<div class="form container">
    <h1>Create Contact</h1>

    {!! Form::open(['url' => 'contacts', 'class' => 'form', 'id' => 'contactCreateForm']) !!}

        @include('contactFolder._contactForm', ['submitButtonText' => 'Create Contact', 'edit' => false])

    {!! Form::close() !!}

    @include('errors._list')
</div>
@endsection

@section('javascript')
	<script>
		$(document).ready(function(){

			$('#contactCreateForm').validate({
			errorElement: 'div',
		});

			@include('javascript._phoneJavascript')
		});
	</script>
@endsection
