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
<div class="form-group">
    {!! Form::label('phone_number', 'Phone Number: ') !!}
    <!-- {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}   -->

    <!-- {!! Form::open(['action' => ['GuestListController@addPhone', $guest->contact_id], 'novalidate' => 'novalidate', 'files' => true]) !!}     -->
            <div class="form-group">

                <div class="input_fields_wrap"> 
                <a href="#" class="add_field_button"> <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                @if(count($phones) == 0)
                    <div>
                        <input type="text" name="phone[]" class="chat_in">
                    </div>
                @endif 
                 @foreach($phones as $phone)
                    <div>
                        <input type="text" name="phone[]" value="{{$phone->phone_number}}" class="chat_in">
                    </div>
                 @endforeach
                 

                </div>
            </div>
              <!-- <input type="submit" name="update" value="Update">           -->
</div>
<br/>
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