<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Istuary Event CRM</title>

    <!-- Fonts -->
    <link rel="stylesheet" type="text/css" href="/css/framework.css">
    <link href='https://fonts.googleapis.com/css?family=Rajdhani:600' rel='stylesheet' type='text/css'>
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
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top clearfix">
        <div class="container">
            <div class="navbar-header navbar-left">
                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    Istuary Event Management & CRM
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    <!-- Loging code here is irrelevent because you should always be redirected out if not loged in-->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                    @else
                        <li class="dropdown">
                            <p>Active users: 1</p>

                            <a href="{{ url('/logout') }}" role="button" aria-expanded="false">Logout {{ Auth::user()->name }}</a>
                        </li>

                    @endif
                </ul>
            </div>
        </div>

        <!-- Left Side Of Navbar -->
        <div class="subnav">
            @if(!Auth::guest())
            <ul class="second-navbar">
                <li>
                    <a href="{{ url('/events/') }}">EVENTS</a>
                </li>
                <li>
                    <a href="{{ url('/contacts') }}">CONTACTS</a>
                </li>
            </ul>
            @endif 
        </div>
    </nav>

    @yield('content')

    

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!--{{-- <script src="{{ elixir('js/app.js') }}"></script> --}}-->
    @yield('javascript')
</body>
</html>
