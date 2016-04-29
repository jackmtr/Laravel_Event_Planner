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
              
            <div class="form-group">
                <!-- <span>Phone: <input type="text" value="{{$phone}}"/>  -->
                <!-- <div><input type="text" name="mytext[]"></div>
                <button class="add_field_button"><i class="fa fa-plus-circle" aria-hidden="true"></i></button> -->
                <!-- </span> -->

                <div class="input_fields_wrap">
                    <button class="add_field_button">Add More Fields</button>
                    <div><input type="text" name="mytext[]"></div>
                </div>
            </div>
        
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

@section('js')

<!-- <script type="{{asset('js/app.js')}}"></script> -->
<script type="text/javascript">
   $(document).ready(function() {

    alert('hi');
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

</script>

@endsection
