@extends('layouts.app')

@section('content')
<div class="contacts container" ng-app="">

	<div class="subnav">

		<h2>Contacts</h2>
      @include('flash')
		<div class="right-subnav-contact">
			<a href="{{ url('/contacts/create') }}"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Contact</a><br/>
			<div class="port-buttons">
				<a href="#" ng-click="popupImport=true" class="portButton"><i class="fa fa-download portButton" aria-hidden="true"></i> Import Contacts</a><br/>
				<a href="{{url('/export/contacts') }}" class="portButton"><i class="fa fa-upload" aria-hidden="true"></i> Export Contacts</a>			
			</div>
		</div>

			<div class="popup ng-hide" style="display: block;" ng-show="popupImport">
				<div class="popup-mask">
				  <div class="panel">
				    <div class="panel-inner">

						{!! Form::open(['action' => 'CSVController@importContacts', 'method' => 'POST', 'files' => true]) !!}
							{!! Form::file('csvContacts', ['class' => 'fileinput']) !!}
							{!! Form::submit("Import Contacts", ['class' => 'btn btn-primary form-control button-default import']) !!}
						{!! Form::close() !!}

				      <p class="link-cancel">
				        <a href="#" ng-click="popupImport=false;">No, take me back.</a>
				      </p>

				    </div>
				  </div>
				</div>
			</div>
	</div>


	<div class="contact-nav-bar">
		{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
			{!! Form::text("searchitem", "", ['placeholder'=>'First or Last Name']) !!}
			{!! Form::submit("Search Contacts") !!}
		{!! Form::close() !!}
	</div>

	<div>
		<table class="sg-table">
			<tr>
				<th>Delete</th>
				<th>
					{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
						{!! Form::hidden("sortby", "first_name") !!}

						{!! Form::button('First Name:<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>', ['type'=>'submit', 'class'=>'sorter']) !!}

					{!! Form::close() !!}
				</th>
				<th>
					{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
						{!! Form::hidden("sortby", "last_name") !!}

						{!! Form::button('Last Name:<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>', ['type'=>'submit', 'class'=>'sorter']) !!}

					{!! Form::close() !!}
				</th>
				<th class="responsive-minimum">Email</th>
				<th class="responsive-minimum">Phone Number</th>
				<th class="responsive-remove">Occupation</th>
				<th>
					{!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
						{!! Form::hidden("sortby", "company") !!}
						{!! Form::button('Company:<i class="fa fa-sort-alpha-asc" aria-hidden="true"></i>', ['type'=>'submit', 'class'=>'sorter']) !!}
					{!! Form::close() !!}
				</th>
				<th class="responsive-remove">Notes</th>
				<th class="responsive-remove">Added By</th>
			</tr>

			@if (count($contacts) > 0)
				@foreach($contacts as $contact)
					<tr>
						<td>
							<button type="button" name="button" class="sorter" id="delete" ng-click="popupdelete{{$contact['contact_id']}}=true"><i class="fa fa-trash" aria-hidden="true"></i></button>
						</td>
						<td ng-click="popup{{$contact['contact_id']}}=true">{{$contact['first_name']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true">{{$contact['last_name']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true" class="responsive-minimum">{{$contact['email']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true" class="responsive-minimum">{{$contact['display_phoneNumber']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true" class="responsive-remove">{{$contact['occupation']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true">{{$contact['company']}}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true" class="responsive-remove">{{ str_limit($contact['notes'], $limit = 27, $end = '...') }}</td>
						<td ng-click="popup{{$contact['contact_id']}}=true" class="responsive-remove">{{$contact['whoAdded']}}</td>
					</tr>
				@endforeach
			@else
					<p>No Contacts Exist</p>
			@endif
		</table>
		<div class="pagination"> {{$contacts->links()}} </div>
	</div>

	@foreach($contacts as $contact)
	<div class="popup ng-hide" style="display: block;" ng-show="popupdelete{{$contact['contact_id']}}">
		<div class="popup-mask">
		  <div class="panel">
		    <div class="panel-inner">
		      <h2>Are you sure you want to delete this contact?</h2>

				{!! Form::open(['method' => 'DELETE', 'url' => 'contacts/' . $contact->contact_id]) !!}
					{!! Form::submit("Delete Contact", ['class' => 'btn btn-primary form-control button-default']) !!}
				{!! Form::close() !!}

		      <p class="link-cancel">
		        <a href="#" ng-click="popupdelete{{$contact['contact_id']}}=false;">No, take me back.</a>
		      </p>

		    </div>
		  </div>
		</div>
	</div>

	<div class="popup ng-hide" style="display: block;" ng-show="popup{{$contact['contact_id']}}">
		<div class="popup-mask">
			<div class="panel">
				<div class="panel-inner">
					<div class="popup-cancel">
						<a href="#" ng-click="popup{{$contact['contact_id']}}=false;"><i class="fa fa-fw fa-times"></i></a>
					</div>

					<div class="edit-events container">

						<h2>Edit Information for {{$contact['first_name'] . " " . $contact['last_name']}}</h2>

						{!! Form::model($contact, ['method' => 'PATCH', 'action' => ['ContactController@update', $contact['contact_id']],'class' => 'form inputform',  'id' => 'contactCreateForm']) !!}

							@include('contactFolder._contactForm', ['submitButtonText' => 'Edit Contact', 'edit' => true, 'object' => $contact])

						{!! Form::close() !!}
						@include('errors._list')
						<div>
						<h2>Upcoming Attending Events</h2>

							<ul>
								@forelse($contact['ongoing_events'] as $ongoingEvent)
									<li>{{$ongoingEvent}}</li>
								@empty
									<li>This contact is currently not registered for any upcoming event.</li>
								@endforelse
							</ul>
						</div>
						<br/>
						<div>
						<h2>Previously Attended Events</h2>

							<ul>
								@forelse($contact['past_events'] as $previousEvent)
									<li>{{$previousEvent}}</li>
								@empty
									<li>This contact has not attended any previous event.</li>
								@endforelse
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div>
@endsection

@section('javascript')
	<script>
		$(document).ready(function(){

			$('#contactCreateForm').validate({
				errorElement: 'div',
			});
			@include('javascript._phoneJavascript')

			$('.sorter').hover(
					function(){
						$(this).css("background-color", "gray").css('color','white');
			},function(){
						$(this).css("background-color", "white").css('color','gray');
					}
				);
		});
		//Adding some color on the selected sorting button
	</script>
@endsection
