@extends('layouts.app')
@section('content')

<div class="guest-details">
    <div class="container">
        <h1>Guest Details</h1>

            <div class="form-group">
                <h2>Name: </h2>
                <p>{{$guest['first_name'] . " " . $guest['last_name']}}</p>
            </div>
            <div class="form-group">
                <h2>Title: </h2>
                <p>{{$guest['occupation'] }}</p>
            </div>   
            <div class="form-group">
                <h2>Company: </h2>
                <p>{{$guest['company'] }}</p>      
            </div>   
            <div class="form-group">
                <h2>Phone: </h2>
                <p>hey</p>
            </div>
            <div class="form-group">
                <h2>Email: </h2>
                <p>{{$guest['email'] }}</p>    
               
            </div>   
            <div class="form-group">
                <h2>WechatID: </h2>
                <p>{{$guest['wechat_id'] }}</p>
            </div>   
            <div class="form-group">
                <h2>Notes: </h2>
                <p>{{$guest['notes'] }}</p>
            </div> 
        </div>       
</div>
@endsection