<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, maximum-scale=1, minimum-scale=1" />
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <title>Istuary Event CRM</title>
    <link rel="stylesheet" type="text/css" href="/css/framework.css"/>
    <link href='https://fonts.googleapis.com/css?family=Rajdhani:600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="container navbar-main">
            <div class="navbar-logo navbar-top-left">
                    <a href="{{ url('/') }}">Istuary Event Management &amp; CRM</a>
            </div>
<!--
            <div class="navbar-active-users navbar-top-middle">
                <p>
                    Active users: 1
                </p>
            </div> -->

            <div class="navbar-auth navbar-auth">
                <ul>
                    <li>
                        <a href="/register">Register <span>New Event Coordinator</span></a>
                    </li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="{{ url('/logout') }}" role="button" aria-expanded="false"><span><i class="fa fa-sign-out" aria-hidden="true"></i>
 </span>Logout <span>{{ Auth::user()->name }}</span></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        <!-- Left Side Of Navbar -->
        <div class="navbar-menu">
            <div class="container">
                <ul>
                    <li>
                        <a href="{{ url('/events/') }}" class="eventSide" id="eventSide">EVENTS</a>
                    </li>
                    <li>
                        <a href="{{ url('/contacts') }}" class="contactSide" id="contactSide">CONTACTS</a>
                    </li>
                </ul>
            <div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script>
    $(function(){
        console.log(window.location.href);
        var catagory = window.location.href;
        if (catagory.indexOf("event") > 1) {
            console.log("we are on the events side");
            $('#eventSide').css("background-color: blue")
            $("#eventSide").addClass("selected");
        }else if (catagory.indexOf("contact") > 1){
            console.log("we are on the contacts side");
            $("#contactSide").addClass("selected");
        }
    });

    </script>
    <!--{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}-->
    @yield('javascript')
</body>
</html>
