<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Istuary Event CRM</title>
    <link rel="stylesheet" type="text/css" href="/css/framework.css"/>
    <link href='https://fonts.googleapis.com/css?family=Rajdhani:600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">    
</head>

<body><!--id="app-layout" -->

    <nav class="navbar"> <!-- navbar-default navbar-static-top clearfix-->
        <div class="container">

            <div> <!--class="navbar-header navbar-left"-->
                <a class="navbar-logo" href="{{ url('/') }}"> <!--class="navbar-brand" -->
                    Istuary Event Management & CRM
                </a>
            </div>

            <div> <!-- class="collapse navbar-collapse" id="app-navbar-collapse"-->
                <!-- Right Side Of Navbar -->
                <ul class="navbar-menu"> <!--class="nav navbar-nav navbar-right"-->
                        <li> <!--class="dropdown"-->
                            <p>
                                Active users: 1
                            </p>

                            <a href="{{ url('/logout') }}" role="button" aria-expanded="false">Logout {{ Auth::user()->name }}</a>
                        </li>
                </ul>
            </div>
        </div>

        <!-- Left Side Of Navbar -->
        <div> <!--class="subnav"-->
            <ul class="navbar-menu"> <!-- class="second-navbar"-->
                <li>
                    <a href="{{ url('/events/') }}">EVENTS</a>
                </li>
                <li>
                    <a href="{{ url('/contacts') }}">CONTACTS</a>
                </li>
            </ul>
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
