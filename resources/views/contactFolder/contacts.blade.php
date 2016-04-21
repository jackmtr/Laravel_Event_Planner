@extends('layouts.app')

@section('content')
<a href="{{ url('/contacts/create') }}"> (icon) Add Contact</a>
<p>A list of all contacts</p>
@endsection