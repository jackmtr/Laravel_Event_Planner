<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width; maximum-scale=1; minimum-scale=1;" />
        <title>Istuary Event CRM</title>
        <link rel="stylesheet" type="text/css" href="/css/framework.css"/>
        <link href='https://fonts.googleapis.com/css?family=Rajdhani:600' rel='stylesheet' type='text/css'>
    </head>
    <body class="login">
        <div class="flexbox">
            <h2>Istuary Event Management & CRM</h2>

            <h2>Reset Password</h2>

            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            {!! Form::open(['url' => '/password/email', 'class' => 'form inputform registerForm', 'novalidate' => 'novalidate', 'files' => 'true']) !!}
          
                <div class="form-group">
                    {!! Form::label('email', 'Email Address: ') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'resetEmail']) !!}
                </div>                

                <div class="form-group">
                    {!! Form::submit("Send Password Reset Link", ['class' => 'btn btn-primary form-control button-default import']) !!}
                </div>   

            {!! Form::close() !!}

            <a href="{{ url('/login') }}" class="btn btn-link" >Return back to login page.</a>
            @include('errors._list')

        </div>
    </body>
</html>