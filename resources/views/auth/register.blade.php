<!DOCTYPE html>
<html lang="zxy">
<head>
	<meta charset="utf-8">
	<title>Registration Page</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
</head>
<body>

<div class="container">
	<div class="row">
		<form action="checkCredentials" method="POST">
			<div class="results">
				@if(Session::get('fail'))
					<div class="alert alert-danger">{{ Session::get('fail') }}</div>
				@endif
			</div>

			<div class="row">
				<div class="col-md-6">
					<label for="forename">First Name</label>
					<input type="email" class="form-control" id="forename" placeholder="First Name">
				</div>
				<div class="col-md-6">
					<label for="surname">Last Name or Surname</label>
					<input type="password" class="form-control" id="surname" placeholder="Last Name">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" placeholder="Username">
				</div>
				<div class="col-md-6">
					<label for="email">E-Mail</label>
					<input type="text" class="form-control" id="email" placeholder="Your eMail">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="password_one">Password</label>
					<input type="password" class="form-control" id="password_one" placeholder="Password">
				</div>
				<div class="col-md-6">
					<label for="password_two">Password Again</label>
					<input type="password" class="form-control" id="password_two" placeholder="Confirm Password">
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<label for="inputCountry">Country</label>
					<select id="inputGenre" class="form-control">
						<option value="GR">Greece</option>
						<option value="CY">Cyprus</option>
					</select>
				</div>
				<div class="col-md-4">
					<label for="inputGenre">Genre</label>
					<select id="inputGenre" class="form-control">
						<option value="1">Action</option>
						<option value="2">Drama</option>
						<option value="3">Horror</option>
						<option value="4">Thriller</option>
					</select>
				</div>
				<div class="col-md-2">
					<label for="inputSex">Sex</label>
					<select id="inputSex" class="form-control">
						<option value="1">Male</option>
						<option value="2">Female</option>
						<option value="3">Non Binary</option>
						<option value="4">I'd like not share</option>
					</select>
				</div>
			</div>
			<div class="form-group">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="gridCheck">
					<label class="form-check-label" for="gridCheck">Check me out</label>
				</div>
			</div>
			<button type="submit" class="btn btn-primary">Sign in</button>
		</form>
	</div>
</div>

@include('footer')

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
	<script type="application/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>