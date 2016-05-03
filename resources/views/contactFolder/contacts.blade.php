@extends('layouts.app')

@section('content')
<div class="contacts container" ng-app="">
	<div class="subnav">
		<h2>Contacts</h2>
		<a href="{{ url('/contacts/create') }}">[ + ] Add Contact</a>
	</div>

	<div class="contact-nav-bar">
		{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
			{!! Form::text("searchitem", "", ['placeholder'=>'First or Last Name']) !!}
			{!! Form::submit("Search Contacts") !!}
		{!! Form::close() !!}
		<div class="scroller" style="height: 600px; overflow-y: scroll; max-height: 1000px; ">
			<table class="sg-table table">
				<thead>
					<tr>
						<th>CheckBox</th>
						<th>
							{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
								{!! Form::hidden("sortby", "first_name") !!}
								{!! Form::submit("First Name") !!}
							{!! Form::close() !!}
						</th>
						<th>
							{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
								{!! Form::hidden("sortby", "last_name") !!}
								{!! Form::submit("Last Name") !!}
							{!! Form::close() !!}
						</th>
						<th class="responsive-minimum">Email</th>
						<th class="responsive-minimum">Phone Number</th>
						<th class="responsive-remove">Occupation</th>
						<th>
							{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
								{!! Form::hidden("sortby", "company") !!}
								{!! Form::submit("Company") !!}
							{!! Form::close() !!}
						</th>
						<th class="responsive-remove">Notes</th>
						<th class="responsive-remove">Added By</th>
					</tr>
				</thead>
				{{Form::open(array('action' => 'GuestListController@store', 'method' => 'post', 'name'=>'guest_list_submit'))}}
				
				<div class="search-event">
					<label for="events">Select an Event: </label>
					<select id="events" name="events">
						@foreach($events_active_open as $event)
							<option value="{{$event['event_id']}}">{{$event['event_name']}}</option>
						@endforeach
					</select>
					<input type="submit" name="guest_list_submit" value="Invite" />	
				</div>
				<tbody>
				@if (count($contacts) > 0)
					@foreach($contacts as $contact)

						<tr id="article-item">
							<td class='cellcheckbox'>
								{!! Form::label("invitelist[]", " ", array('class' => 'label-checkbox')) !!}
								{{ Form::checkbox('invitelist[]', $contact['contact_id'], false, ['id' => 'invitecheckbox'.$contact["contact_id"]]) }}
								<span></span>
							</td>
							<td ng-click="popup{{$contact['contact_id']}}=true">{{$contact['first_name']}}</td>
							<td>{{$contact['last_name']}}</td>
							<td class="responsive-minimum">{{$contact['email']}}</td>
							<td class="responsive-minimum">{{$contact['display_phoneNumber']}}</td>
							<td class="responsive-remove">{{$contact['occupation']}}</td>
							<td>{{$contact['company']}}</td>
							<td class="responsive-remove">{{$contact['notes']}}</td>
							<td class="responsive-remove">{{$contact['added_by']}}</td>
						</tr>
					@endforeach
				</tbody>
				@else
						<p>No Contacts Exist</p>
				@endif
			</table>

			<div id="pagination" class="pagination"  style="display: none"> 
				{!! $contacts->render() !!} 
			</div>	
		</div>

		{{Form::close()}}
	</div>
	@foreach($contacts as $contact)
            <div class="popup ng-hide" style="display: block;" ng-show="popup{{$contact['contact_id']}}">
              <div class="popup-mask">
                <div class="panel">
                  <div class="panel-inner">
                    <div class="popup-cancel">
                      <a href="#" ng-click="popup{{$contact['contact_id']}}=false;"><i class="fa fa-fw fa-times"></i></a>
                    </div>
                    <div class="edit-events container">
                      <h2>Edit Information for {{$contact['first_name'] . " " . $contact['last_name']}}</h2>
                      {!! Form::model($contact, ['method' => 'PATCH', 'action' => ['ContactController@update', $contact['contact_id']],'class' => 'form', 'novalidate' => 'novalidate', 'files' => true]) !!}
                        @include('contactFolder._contactForm', ['submitButtonText' => 'Edit Contact'])
                      {!! Form::close() !!}        
                    </div>
                  </div>
                </div>
              </div>
            </div>
    @endforeach
</div>

@endsection

@section('javascript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery.infinitescroll.min.js"></script>

<script>
	$(document).ready(function(){
		$('.cellcheckbox').on('click', 'span', function(){
			var checkbox = $(this).parent().find("input");
			checkbox.prop("checked", !checkbox.prop("checked"));
		});

		/*$('ul.pagination:visible:first').hide();
	
        $('div.scroller').jscroll({
            debug: true,
            autoTrigger: true,
            nextSelector: '.pagination li.active + li a',
            contentSelector: 'div.scroller',
            callback: function() {
 
                //again hide the paginator from view
                $('ul.pagination:visible:first').hide();
 
            }
        });*/

        /*var loading_options - {
        	finishedMsg: "End of rows",
        	msgText: "Loading new rows...:",
        	img: "/images/Timeline.PNG"
        };

        $('table.table tbody').infinitescroll({
        	loading: loading_options,
        	navSelector: "#pagination .pagination",
        	nextSelector: "#pagination .pagination li.active + li a",
        	itemSelector: "#article-item"
        });*/
  (function(){

    var loading_options = {
        finishedMsg: "End of rows",
        msgText: "Loading new rows...",
        img: ""
    };

    $('table.table tbody').infinitescroll({
      behaviour: 'local',
      binder: $('.scroller'),
      loading : loading_options,
      navSelector : "#pagination .pagination",
      nextSelector : "#pagination .pagination li.active + li a",
      itemSelector : "#article-item"
    });
})();

	});
</script>
@endsection
