@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 col-md-offset-1">
      <div class="panel panel-default">
        <div class="panel-heading">Project Outline</div>

        <div class="panel-body">
          <h3>Team Members</h3>
          <ul>
            <li>Phil Weier</li>
            <li>Hassan Hosseinpour</li>
            <li>Jackie Cheng</li>
            <li>Rosalia Matzumiya</li>
            <li>Slav Dujakoviz</li>
          </ul>
          <h3>Resources</h3>
          <ul>
            <li><a href="https://app.zeplin.io/project.html#pid=571519d7c7312f087aaab277&dashboard">Wireframes</a></li>
            <li><a href="https://github.com/philweier/istuary_event_crm.git">GitHub Repo</a></li>
            <li><a href="http://ec2-54-187-26-151.us-west-2.compute.amazonaws.com:5000/">Istuary UI Framework</a></li>
            <li><a href="https://bcit-istuary.slack.com">Slack</a></li>
            <li><a href="https://docs.google.com/spreadsheets/d/1f8GCFfC76Y-VBU9_Vw1UOBd4wKu5u1xAUujHznWfXGo/edit?ts=5715686f#gid=0">Scrum Document</a></li>
          </ul>
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
                <li>Assign table seating with guests</li>
                <li>Update guest attendance status at event</li>
                <li>Support multiple event planner logins and track contacts added and guests checked in</li>
                <li>Real-time updates of views to reflect changes to database</li>
              </ul>
            </li>
            <li>Important
              <ul>
                <li>Display active event planners</li>
              </ul>
            </li>
            <li>Nice to have
              <ul>
                <li>Buddy Seating</li>
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
          <img src="/images/Istuary_Events_UseCase_V1.0.png" alt="Use Case Diagram" width="600"/>
          <h3>CRUD</h3>
          <img src="/images/Istuary_Events_Crud_V1.0.png" alt="CRUD" width="600"/>
          <h3>ERD</h3>
          <img src="/images/ERD2016-04-20.png" alt="Entity Relationship Diagram" width="600"/>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
