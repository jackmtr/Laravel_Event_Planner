<div class="form-group">
    {!! Form::label('first_name', 'First Name: ') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('last_name', 'Last Name: ') !!}
    {!! Form::text('last_name', null, ['class' => 'form-control', 'required']) !!}
</div>

<div class="form-group">
    {!! Form::label('company', 'Company: ') !!}
    {!! Form::text('company', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('occupation', 'Occupation: ') !!}
    {!! Form::text('occupation', null, ['class' => 'form-control']) !!}
</div>

@if($edit)
    @forelse($object['phoneNumber'] as $i => $phonenumber)
        @if($i == 0)
            <div class="form-group">
                {!! sprintf(Form::label('phone_number'. ($i+1), '%s', array('class' => 'control-label tncs-label')), '<a href="#" class="add_phone"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> Phone Number' . ($i+1) . ':') !!}
                {!! Form::text('phone_number'. ($i+1), $phonenumber['phone_number'], ['class' => 'form-control', 'name' => 'phonegroup[]']) !!}
            </div>
        @else
            <div class="form-group delete-phone-numbers"><a href="#" class="remove_field"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>
                {!! sprintf(Form::label('phone_number'. ($i+1), '%s', array('class' => 'control-label tncs-label')), ' Phone Number' . ($i+1) . ':') !!}
                {!! Form::text('phone_number'. ($i+1), $phonenumber['phone_number'], ['class' => 'form-control', 'name' => 'phonegroup[]']) !!}
            </div>        
        @endif
        <!--{{$phoneindex++}}-->
    @empty
        <div class="form-group delete-phone-numbers">
        {!! sprintf(Form::label('phone_number', '%s', array('class' => 'control-label tncs-label')), '<a href="#" class="add_phone"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> Phone Number 1: ') !!}
        {!! Form::text('phone_number', null, ['class' => 'form-control', 'name' => 'phonegroup[]']) !!}
        </div>
        <!--{{$phoneindex++}}-->
    @endforelse

@else
    <div class="form-group delete-phone-numbers">
        {!! sprintf(Form::label('phone_number', '%s', array('class' => 'control-label tncs-label')), '<a href="#" class="add_phone"><i class="fa fa-plus-circle" aria-hidden="true"></i></a> Phone Number: ') !!}
        {!! Form::text('phone_number', null, ['class' => 'form-control', 'name' => 'phonegroup[]']) !!}
    </div>
    <!--{{$phoneindex++}}-->
@endif

<!-- new phone inputs come here -->
<div class="new-phone-numbers delete-phone-numbers"></div>



<div class="form-group">
    {!! Form::label('email', 'Email: ') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('wechat_id', 'Wechat Id: ') !!}
    {!! Form::text('wechat_id', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('notes', 'Notes: ') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
</div>
<br/>

<div class="form-group innerPopupEventSubmit">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control button-default']) !!}
</div>