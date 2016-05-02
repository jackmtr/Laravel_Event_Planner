@extends('layouts.app')

@section('content')

<div class="edit-events container">
	<h2>Edit Event {!! $event->event_name !!}</h2>
	<div>
        {!! Form::model($event, ['method' => 'POST', 'action' => ['EventController@duplication', $event->event_id],'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
	        <div class="eevents">
	        	<div>
	        		@include('eventFolder._eventForm', ['submitButtonText' => 'Duplicate Event'])
	        	</div>	        
	        	<div>
	        		<h2>Invite List</h2>
	            		@forelse($guestList as $guest)
	            			<div class="cellcheckbox">
		            			{!! Form::label('invitelist[]', $guest['first_name'] . " " . $guest['last_name'], array('class' => 'label-checkbox')) !!}
		            			{!! Form::checkbox('invitelist[]', $guest['contact_id'], array('id' => 'invitecheckbox'. $guest["contact_id"])) !!}
	            			<span></span>
	            			</div>
	            		@empty
	            			<p>There are currently no guests to bring over.</p>
	            		@endforelse
	        	</div>

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