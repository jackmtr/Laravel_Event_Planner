<div class="form-group">
    {!! Form::label('first_name', 'First Name: ') !!}
    {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
</div>
<br/>

<div class="form-group">
{!! Form::label('last_name', 'Last Name: ') !!}
{!! Form::text('last_name', null, ['class' => 'form-control']) !!}
</div>
<br/>

<div class="form-group">
{!! Form::label('email', 'Email: ') !!}
{!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>
<br/>

<div class="form-group">
{!! Form::label('occupation', 'Occupation: ') !!}
{!! Form::text('occupation', null, ['class' => 'form-control']) !!}
</div>
<br/>

<div class="form-group">
{!! Form::label('company', 'Company: ') !!}
{!! Form::text('company', null, ['class' => 'form-control']) !!}
</div>
<br/>

@if($edit)
    @forelse($object['phoneNumber'] as $i => $phonenumber)
        <div class="form-group delete-phone-numbers">
        {!! Form::label('phone_number'. ($i+1), 'Phone Number ' . ($i+1) . ':') !!}
        {!! Form::text('phone_number' . ($i+1), $phonenumber['phone_number'], ['class' => 'form-control', 'name' => 'phonegroup[]']) !!}
        @if($i != 0)
            <a href='#' class='remove_field'> <i class='fa fa-minus-circle' aria-hidden='true'></i></a>
        @endif
        </div>
    <!--{{$phoneindex++}}-->
    @empty
        <div class="form-group">
            {!! Form::label('phone_number', 'Phone Number 1: ') !!}
            {!! Form::text('phone_number', null, ['class' => 'form-control', 'name' => 'phonegroup[]']) !!}
        </div>
    @endforelse

@else
    <div class="form-group">
        {!! Form::label('phone_number', 'Phone Number 1: ') !!}
        {!! Form::text('phone_number', null, ['class' => 'form-control', 'name' => 'phonegroup[]']) !!}
    </div>
@endif

<!-- new phone inputs come here -->
<div class="new-phone-numbers delete-phone-numbers"></div>

<a href="#" class="add_phone"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>

<div class="form-group">
    {!! Form::label('wechat_id', 'Wechat Id: ') !!}
    {!! Form::text('wechat_id', null, ['class' => 'form-control']) !!}
</div>
<br/>

<div class="form-group">
    {!! Form::label('notes', 'Notes: ') !!}
    {!! Form::textarea('notes', null, ['class' => 'form-control']) !!}
</div>
<br/>

<div class="form-group">
    {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
</div>