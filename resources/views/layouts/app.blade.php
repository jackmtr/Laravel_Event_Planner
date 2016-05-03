<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width; maximum-scale=1; minimum-scale=1;" />
    <title>Istuary Event CRM</title>
    <link rel="stylesheet" type="text/css" href="/css/framework.css"/>
    <link href='https://fonts.googleapis.com/css?family=Rajdhani:600' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!--<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'>-->

    <!-- Styles -->
    <!--{{-- <link href="{{ elixir('css/framework.css') }}" rel="stylesheet"> --}}-->

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">    
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>
    <script type="text/javascript" src="/js/dialog/dialog.js"></script>
</head>

<body>
    <nav class="navbar">
        <div class="container navbar-main"> 
            <div class="navbar-logo navbar-top-left">
                    <a href="{{ url('/') }}">
                        Istuary Event Manage<span>ment & CRM</span>
                    </a>
            </div>

            <div class="navbar-active-users navbar-top-middle">
                <p>
                    Active users: 1
                </p>
            </div>

            <div class="navbar-auth navbar-auth">
                <ul>
                    <li>
                        <a href="#">Register <span>New Event Coordinator</span></a>
                    </li>
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <a href="{{ url('/logout') }}" role="button" aria-expanded="false"><span>[ - ]</span>Logout <span>{{ Auth::user()->name }}</span></a>
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
                        <a href="{{ url('/events/') }}">EVENTS</a>
                    </li>
                    <li>
                        <a href="{{ url('/contacts') }}">CONTACTS</a>
                    </li>
                </ul>
            <div>
        </div>
    </nav>

    @yield('content')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!--{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}-->
    @yield('jquery')
</body>
</html>
