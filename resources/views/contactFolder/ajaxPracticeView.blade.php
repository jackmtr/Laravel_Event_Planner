
/**
 * Created by PhpStorm.
 * User: slavDujakovic
 * Date: 2016-04-29
 * Time: 3:23 PM
 */

@extends('layouts.app')
@section('content')

    {{--{{ Form::open(['action' => ['ContactController@autocomplete'], 'method' => 'GET']) }}--}}
    {{--{{ Form::text('q', '', ['id' =>  'q', 'placeholder' =>  'Enter name'])}}--}}
    {{--{{ Form::submit('Search', array('class' => 'button expand', 'id' => 'ajax_button')) }}--}}
    {{--{{ Form::close() }}--}}
 {{--<div class="row col-lg-5" >--}}
     {{--<h2>Get Request</h2>--}}
 {{--</div>--}}


    <div class="container">
        <br />
        <h2 align="center">Ajax Live Data Search using Jquery PHP MySql</h2><br />
        <div class="form-group">
            {!! Form::open()!!}
            <div class="input-group">
                <span class="input-group-addon">Search</span>
                <input type="text" name="search_text" id="search_text" placeholder="Search by Customer Name" class="form-control" />
            </div>
            {!! Form::close() !!}
        </div>
        <br />
    </div>
    <table id="result">
        <tr>
            <th>CheckBox</th>
            <th>
                {!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
                {!! Form::hidden("sortby", "first_name") !!}
                {!! Form::submit("First Name") !!}
                {!! Form::close() !!}
            </th>
            <th>
                {!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
                {!! Form::hidden("sortby", "last_name") !!}
                {!! Form::submit("Last Name") !!}
                {!! Form::close() !!}
            </th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Occupation</th>
            <th>
                {!! Form::open(['action' => 'ContactController@index', 'method' => 'get']) !!}
                {!! Form::hidden("sortby", "company") !!}
                {!! Form::submit("Company") !!}
                {!! Form::close() !!}
            </th>
            <th>Notes</th>
            <th>Added By</th>
        </tr>
        {{Form::open(array('action' => 'GuestListController@store', 'method' => 'post', 'name'=>'guest_list_submit'))}}

        <tbody id="tbody">
        @if (count($contacts) > 0)

            @foreach($contacts as $contact)
                <tr class="row">
                    <td class='cellcheckbox'>
                        {!! Form::label("invitelist[]", " ", array('class' => 'label-checkbox')) !!}
                        {{ Form::checkbox('invitelist[]', $contact['contact_id'], false, ['id' => 'invitecheckbox'.$contact["contact_id"]]) }}
                        <span></span>
                    </td>
                    <td id="firstname">{{$contact['first_name']}}</td>
                    <td id="lastname">{{$contact['last_name']}}</td>
                    <td id="email">{{$contact['email']}}</td>
                    <td id="phone">{{$contact['display_phoneNumber']}}</td>
                    <td id="occupation">{{$contact['occupation']}}</td>
                    <td id="company">{{$contact['company']}}</td>
                    <td id="notes">{{$contact['notes']}}</td>
                    <td id="added_by">{{$contact['added_by']}}</td>
                </tr>
            @endforeach
        @else
            <p>No Contacts Exist</p>
        @endif
        </tbody>
    </table>








@endsection