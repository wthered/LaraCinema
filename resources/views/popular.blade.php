<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Popular Films</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
</head>
<body>

@include('NavigationBar')

<div class="container">
	<div class="row">
		<div class="col-md-3">Left Panel</div>
		<div class="col-md-9">
			<h1>Popular Film List</h1>
			<div class="row">
			@foreach($film_list as $film_item)
				<div class="col-xs-12 col-sm-6 col-md-4">
					@include('film.card', [ 'code' => '', 'item' => $film_item ])
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>

@include('footer')

<script type="application/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script type="application/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="application/javascript" src="{{ asset('js/app.js') }}"></script>
</body>
</html>