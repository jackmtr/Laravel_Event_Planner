@extends('layouts.app')
@section('content')
<div class="guest-details">
    <div class="container">
        <h1>Guest Details</h1>
            <div class="form-group">
                <h2>Name: {{$guest['first_name'] . " " . $guest['last_name']}}</h2>
            </div>
            <div class="form-group">
                <h2>Title: {{$guest['occupation'] }} </h2>
            </div>   
            <div class="form-group">
                <h2>Company: {{$guest['company'] }}</h2>     
            </div>   
            {!! Form::open(['action' => ['GuestListController@addPhone', $guest->contact_id], 'novalidate' => 'novalidate', 'files' => true]) !!}    
            <div class="form-group">

                <div class="input_fields_wrap"> 
                 @foreach($phones as $phone)
                    <div>
                        <input type="text" name="mytext[]" value="{{$phone->phone_number}}" class="chat_in"><a href="#" class="add_field_button"> <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </div>
                 @endforeach
                </div>
            </div>
              <input type="submit" name="update" value="Update">
        {{Form::close()}}
            <div class="form-group">
                <h2>Email: {{$guest['email'] }}</h2>  
               
            </div>   
            <div class="form-group">
                <h2>WechatID: {{$guest['wechat_id'] }}</h2>
            </div>   
            <div class="form-group">
                <h2>Notes: {{$guest['notes'] }}</h2>
            </div> 
        </div>   

        <div class="form-control">
            <a href="{{ url('/contacts/'.($guest->contact_id)).'/edit' }}"> <i class="fa fa-pencil" aria-hidden="true"></i> Edit Contact</a>   
        </div> 
</div>
@endsection

@section('jquery')

<!-- <script type="{{asset('js/app.js')}}"></script> -->
<script type="text/javascript">
   $(document).ready(function() {

    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    var data            = $("#newPhone");         //new phone input id
    var newPhone        = data.val();
    var action          = 'addPhone';
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e)
    { //on add input button click
        e.preventDefault();

        $.post(action, { add_button: newPhone }, function (response) 
        {
            if (response) {

                if(x < max_fields)
                { 
                    x++; //text box increment
                    $(wrapper).append('<div><input type="text" name="mytext[]" class="chat_in"/><a href="#" class="remove_field"> <i class="fa fa-minus-circle" aria-hidden="true"></i></a></div>'); //add input box
                } //max input box allowed     
                $(wrapper).on("click",".remove_field", function(e)
                { //user click on remove text
                    e.preventDefault(); $(this).parent('div').remove(); x--;
                }) //end of remove field 
// ​
                
            } else {
                alert('error');
            }
        
    });//end of on click
    
}); 



});//end of document ready function



</script>

@endsection
