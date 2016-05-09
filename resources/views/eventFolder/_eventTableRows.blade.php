<tr>
	<td>
		@if($status == 0)
			{!! Form::select('rsvp', [0 => 'Invited', 1 => 'Going', 2 => 'Not Going', 3 => 'Remove Guest'], $guest['rsvp'], ['class' => 'status invited ajaxSelect', 'id' => $guest['guest_list_id'] ] ) !!}
		@elseif($status == 1)
			{!! Form::select('rsvp', [0 => 'Not Checked In', 1 => 'Checked In'], $checkStatus, ['class' => 'status checkin ajaxSelect', 'id' => $guest['guest_list_id'] ] ) !!}
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
			<button>Invite</button>
		@endif
	</td>
	<td ng-click="popup{{$guest['contact']['contact_id']}}=true">N/A</td>
	<td ng-click="popup{{$guest['contact']['contact_id']}}=true">{{$guest['name']}}</td>
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
    <td ng-click="popup{{$guest['contact']['contact_id']}}=true" class="responsive-remove">{{$guest['work']}}</td>
    <td ng-click="popup{{$guest['contact']['contact_id']}}=true" class="responsive-remove">{{$guest['note']}}</td>
</tr>
