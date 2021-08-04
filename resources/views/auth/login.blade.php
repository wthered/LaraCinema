<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="utf-8">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/login.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>

<div class="form-container">
	<form action="check" method="post">
		<div class="results">
			@if(Session::has('fail'))
				<div class="alert alert-danger">{{ Session::get('fail') }}</div>
			@endif
		</div>

		<div class="ma-3">
			<label for="inputUsername" class="form-label">Email address</label>
			<input type="text" class="form-control" id="inputUsername" placeholder="Username" name="username" value="{{ old('username') }}">
			<div class="text-danger form-text">@error('username') {{ $message }} @enderror</div>
		</div>

		<div class="ma-3">
			<label for="inputPassword" class="form-label">Password</label>
			<input type="password" class="form-control" id="inputPassword" placeholder="Password" name="password" value="{{ old('password') }}">
			<div class="text-danger form-text">@error('password') {{ $message }} @enderror</div>
		</div>

		<div>
			<a href="register" class="btn btn-link" style="display: block;">Create New account</a>
		</div>

		@csrf

		<button type="submit" class="btn btn-primary" id="btn-check">Submit</button>
	</form>
</div>

@include('footer')

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
	<script type="application/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>