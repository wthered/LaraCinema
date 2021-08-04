<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Genre Page</title>
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
		<h1>Films at Genre {{ $genre_name }}</h1>
		@foreach($film_list as $film_item)
		<div class='col-sm-4'>{{ $film_item->movie_id }}</div>
		@endforeach
	</div>
</div>

@include('footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script type="application/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>