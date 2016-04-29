@extends('layouts.app')

@section('content')

<div class="edit-events">
    <div class="container">
    	<h2>Edit Event {!! $event->event_name !!}</h2>

            {!! Form::model($event, ['method' => 'POST', 'action' => 'EventController@duplication','class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
            	<div>
            		<h2>Invite List</h2>
	            		@forelse($guestList as $guest)
	            			<div class="cellcheckbox">
		            			{!! Form::label('invitelist[]', $guest->contact['first_name'] . " " . $guest->contact['last_name'], array('class' => 'label-checkbox')) !!}
		            			{!! Form::checkbox('invitelist[]', $guest->contact['contact_id'], ['id' => 'invitecheckbox'.$guest["guest_list_id"]]) !!}
	            			<span></span>
	            			</div>
	            		@empty
	            			<p>There are currently no guests to bring over.</p>
	            		@endforelse
            	</div>
            	<br/>
            	<div>
            		@include('eventFolder._eventForm', ['submitButtonText' => 'Duplicate Event'])
            	</div>

            {!! Form::close() !!}

            @include('errors._list') 
    </div>       
</div>

@endsection

@section('javascript')
	<script>
		$(document).ready(function(){
			$('.cellcheckbox').on('click', 'span', function(){
				var checkbox = $(this).parent().find("input");
				checkbox.prop("checked", !checkbox.prop("checked"));
			});
		});
	</script>
@endsection