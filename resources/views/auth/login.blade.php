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
			<div>
				<form role="form" method="POST" action="{{ url('/login') }}">
				{!! csrf_field() !!}

				<div class="input loginname">
					<label for="email">Email</label>
					<input name="email" type="email" value="{{ old('email') }}" />

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif				
				</div>

				<div class="input loginpassword">
					<label for="password">Password</label>
					<input name="password" type="password"/>
				</div>

				<input class="login-submit" type="submit" value="Login"/>
				<a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
				</form>
			</div>
		</div>
	</body>
</html>