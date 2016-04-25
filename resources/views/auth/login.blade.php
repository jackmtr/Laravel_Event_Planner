<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<title>Istuary Event CRM</title>
		<link rel="stylesheet" type="text/css" href="/css/framework.css">
		<link href='https://fonts.googleapis.com/css?family=Rajdhani:600' rel='stylesheet' type='text/css'>
	</head>
	<body>
		<div class="login">
			<div class="flexbox">
				<h2>Istuary Event Management & CRM</h2>
				<div class="form">
					<form role="form" method="POST" action="{{ url('/login') }}">
					{!! csrf_field() !!}

					<div class="loginname">
						<input name="email" type="email" value="{{ old('email') }}" placeholder="test = admin@email.com" />

	                    @if ($errors->has('email'))
	                        <span class="help-block">
	                            <strong>{{ $errors->first('email') }}</strong>
	                        </span>
	                    @endif				
					</div>

					<div class="loginpassword">
						<input name="password" type="password" placeholder="test = password" />
					</div>

					<input type="submit" value="Login"/>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>