<?php
	use App\Http\Controllers\FilmController;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Film dataBase Site</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
</head>
<body>
	<?php
		$genres = FilmController::getGenreList();
	?>
@include('NavigationBar', [ 'genres' => $genres ])

<div class="container">
	<div class="row">
		<h1 class="film-category">Main</h1>
		@foreach ( $filmList as $filmItem)
			<div class='col-xs-12 col-sm-6 col-md-4'>
				@include('film.card', ['code' => '',  'item' => $filmItem])
			</div>
		@endforeach

		<div class="category-container">
			<div class="film-category-head">
				<h1 class="film-category-name">Latest Films</h1>
				<a href="recent" class="film-category-link">View More&hellip;</a>
			</div>

			<div class='row'>
				@foreach ( $latestFilms['result'] as $latestFilm )
					<div class="col-xs-12 col-sm-6 col-md-4">
						<?php
							$code = preg_replace("/[^a-zA-Z0-9]/", chr(random_int(65,90)), base64_encode(random_bytes(24)));
						?>
						@include('film.card', ['code' => $code,  'item' => $latestFilm])
					</div>
				@endforeach
			</div>
		</div>

		<div class="category-container">
			<div class="film-category-head">
				<h1 class="film-category-name">Most popular Films</h1>
				<a href="popular" class="film-category-link">View More&hellip;</a>
			</div>
			<div class="row">
				@foreach ( $popularFilms as $filmItem)
					<div class='col-xs-12 col-sm-6 col-md-4'>
						<?php
							$code = preg_replace("/[^a-zA-Z0-9]/", chr(random_int(65,90)), base64_encode(random_bytes(24)));
						?>
						@include('film.card', ['code' => $code,  'item' => $filmItem])
					</div>
				@endforeach
			</div>
	</div>
</div>

@include('footer')

<script type="application/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script type="application/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="application/javascript">
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
});
</script>

<script type="application/javascript" src="{{ asset('js/search.js') }}"></script>
</body>
</html>
