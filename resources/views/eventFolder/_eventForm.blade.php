
<div>
    <div class="form-group">
        {!! Form::label('event_name', 'Event Name: ') !!}
        {!! Form::text('event_name', null, ['class' => 'form-control', 'required']) !!}
    </div>
</div>

<div>
    <div class="form-group">
        {!! Form::label('event_date', 'Date: ') !!}
        {!! Form::input('date', 'event_date', $eventDate, ['class' => 'form-control']) !!}
    </div>   

    <div class="form-group">
        {!! Form::label('event_location', 'Location: ') !!}
        {!! Form::text('event_location', null, ['class' => 'form-control']) !!}
    </div>    
</div>

<div>
    <div class="form-group">
        {!! Form::label('event_time', 'Start time: ') !!}
        {!! Form::input('time', 'event_time', $eventTime, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('event_end_time', 'End time: ') !!}
        {!! Form::input('time', 'event_end_time', $eventEndTime, ['class' => 'form-control']) !!}
    </div>        
</div>

<div>
    <div class="form-group">
        {!! Form::label('event_description', 'Description: ') !!}
        {!! Form::textarea('event_description', null, ['class' => 'form-control']) !!}
    </div>
</div>
  
<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control button-default']) !!}
</div> 