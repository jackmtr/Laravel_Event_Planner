<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-envelope"></i>Send Password Reset Link
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
-->

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

            {!! Form::open(['url' => '/password/email', 'class' => 'form', 'novalidate' => 'novalidate', 'files' => 'true']) !!}
          
                <div class="form-group">
                    {!! Form::label('email', 'Email Address: ') !!}
                    {!! Form::text('email', null, ['class' => 'form-control', 'id' => 'email']) !!}
                </div>                

                <div class="form-group">
                    {!! Form::submit("Send Password Reset Link", ['class' => 'btn btn-primary form-control']) !!}
                </div>   

            {!! Form::close() !!}

            <a href="{{ url('/login') }}" class="btn btn-link" >Return back to login page.</a>
            @include('errors._list')

        </div>
    </body>
</html>