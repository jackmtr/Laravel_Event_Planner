@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Project Outline</div>

                <div class="panel-body">
                    <h3>Functional requirments</h3>
                    <ul>
                      <li>Essential
                        <ul>
                          <li>Event planner authentication</li>
                          <li>Mobile responsive</li>
                          <li>CRUD contacts</li>
                          <li>CRUD events</li>
                          <li>Invite individual guests to event</li>
                          <li>Invite previous event attendees to event</li>
                          <li>Update rsvp status for event guests</li>
                          <li>Assign table seating</li>
                          <li>Update guest attendance status at event</li>
                          <li>Support multiple event planner logins and track contacts added and guests checked in</li>
                          <li>Real-time updates of views to reflect changes to database</li>
                        </ul>
                      </li>
                      <li>Important
                        <ul>
                          <li>None so far</li>
                        </ul>
                      </li>
                      <li>Nice to have
                        <ul>
                          <li>None so far</li>
                        </ul>
                      </li>
                    </ul>
                    <h3>Non-functional requirments</h3>
                    <ul>
                      <li>Laravel 5.2</li>
                      <li>PHP 5.6</li>
                      <li>MySQL</li>
                      <li>Istuary UI Framework</li>
                      <li>Sass</li>
                    </ul>
                    <h3>Use Case</h3>
                    <img src="../assets/images/usecase.png" alt="Use Case Diagram"/>
                    <h3>ERD</h3>
                    <img src="../assets/images/erd.png" alt="Entity Relationship Diagram"/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
