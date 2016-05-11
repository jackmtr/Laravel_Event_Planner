<tr>
	<td>
		@if($status == 0)
			{!! Form::select('rsvp', [0 => 'Invited', 1 => 'Going', 2 => 'Not Going', 3 => 'Remove Guest'], $guest['rsvp'], ['class' => 'status ajaxSelect', 'id' => $guest['guest_list_id'] ] ) !!}
		@elseif($status == 1)
			{!! Form::select('rsvp', [0 => 'Not Checked In', 1 => 'Checked In'], $checkStatus, ['class' => 'status ajaxSelect', 'id' => $guest['guest_list_id'] ] ) !!}
		@elseif($status == 2)
			@if($guest['checked_in_by'] != null)
				Attended
			@else
				@if($guest['rsvp']==1)
					No Show
				@else
					Did Not Attend
				@endif
			@endif
		@else
		{!! Form::open(['action' => ['GuestListController@store'], 'method' => 'post']) !!}
		{!! Form::hidden("contactId", $guest['contact']['contact_id']) !!}
		{!! Form::hidden("eventId", $event->event_id) !!}
		{!! Form::submit("Invite", ['class' => 'fakeselect btn btn-primary form-control button-default']) !!}
		{!! Form::close() !!}
		@endif
	</td>	
	<td ng-click="popup{{$guest['contact']['contact_id']}}=true">{{ str_limit($guest['name'], $limit = 27, $end = '...') }}</td>
	<td>
		@if($status < 2)
          <form id='myform' method='POST' action='#'>
            <input name="{{ $guest['guest_list_id'] }}" type='button' value='-' class='qtyminus qtybtn' field='quantity{{$index}}' />
            <input type='number' name='quantity{{$index}}' value="{{ $guest['additional_guests'] }}" class='qty' />
            <input name="{{ $guest['guest_list_id'] }}" type='button' value='+' class='qtyplus qtybtn' field='quantity{{$index}}' />
          </form>
        @else

        @endif
	</td>
    <td ng-click="popup{{$guest['contact']['contact_id']}}=true" class="responsive-remove">{{ str_limit($guest['work'], $limit = 27, $end = '...') }}</td>
    <td ng-click="popup{{$guest['contact']['contact_id']}}=true" class="responsive-remove">
		@if($guest['note'] != null)
		<a href="#" class="tooltip">
		<i class="fa fa-info-circle"></i>
			<div class="inner">
				<div class="arrow"><i class="fa fa-caret-left"></i></div>
				{{ str_limit($guest['note'], $limit = 27, $end = '...') }}
			</div>
		</a>
		@else

        @endif
		</td>		
</tr>
