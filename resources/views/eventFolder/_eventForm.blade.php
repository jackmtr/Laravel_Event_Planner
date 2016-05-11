<div class="form-group">
    {!! Form::label('event_name', 'Event Name: ') !!}
    {!! Form::text('event_name', null, ['class' => 'form-control']) !!}
</div>
<br/>
<div class="form-group">
    {!! Form::label('event_date', 'Date: ') !!}
    {!! Form::input('date', 'event_date', $eventDate, ['class' => 'form-control']) !!} <!--date('Y-m-d') date('h:i')-->
</div>   
<!--Need to cast the date and time with a accessor to cast the value from db for proper format for input-->
<br/>
<div class="form-group">
    {!! Form::label('event_time', 'Time: ') !!}
    {!! Form::input('time', 'event_time', $eventTime, ['class' => 'form-control']) !!}
</div>
<!--Need to cast the date and time with a accessor to cast the value from db for proper format for input-->
<br/>
<div class="form-group">
    {!! Form::label('event_location', 'Location: ') !!}
    {!! Form::text('event_location', null, ['class' => 'form-control']) !!}
</div>
<br/>     
<div>
    {!! Form::label('event_description', 'Description: ') !!}
    {!! Form::textarea('event_description', null, ['class' => 'form-control']) !!}
</div>
<br/>
<div>
    {!! Form::label('num_of_tables','Number of Tables: ') !!}
    {!! Form::text('num_of_tables', null, ['class' => 'form-control']) !!}
</div>
<br/>
<div>
    {!! Form::label('seats_per_table','Seats per Table: ') !!}
    {!! Form::text('seats_per_table', null, ['class' => 'form-control']) !!}
</div>  
<br/>      
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control button-default']) !!}
</div> 