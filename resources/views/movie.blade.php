<?php
	use App\Http\Controllers\FilmController;
	use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title><?php echo $info->title.' ('.$info->year.')'; ?></title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
</head>
<body>

<?php
	$navigationGenres = FilmController::getGenreList();
?>

@include('NavigationBar', [ 'genres' => $navigationGenres ])

<section class="py-5">
	<div class="container py-md-5 py-4">
		<div class="row">
			<h1 class="film-title"><?php echo $info->title; ?> (<?php echo $info->year; ?>)</h1>
			<div class="col-lg-6 pr-lg-5" id="film-info">
				<h4 class="title-style mb-2">Film Plot</h4>
				<p id="film-plot"><?php echo $info->plot; ?></p>
				<h4 class="title-style mb-2">Film Tagline</h4>
				<p id="film-line"><?php echo $info->tagline; ?></p>
				<div class="row my-4 pt-lg-3">
					<div class="features-box">
						<h5 class="my-2">Genres</h5>
						@foreach($genres as $genre)
							<button class="btn btn-genre" value="{{ $genre->genre_id }}">{{ $genre->genre_name }}</button>
						@endforeach
					</div>
				</div>
			</div>
			<div class="col-lg-6 mt-lg-0 mt-sm-5 mt-4">
				<div class="parent">
					<img class="image_this" src="<?php echo $info->backdrop; ?>" alt="<?php echo $info->title.' Photo'; ?>" />
					<img class="image_that" src="<?php echo $info->poster; ?>" alt="<?php echo $info->title.' Poster'; ?>" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-4 features-box">
				<h5 class="my-2">Released</h5>
				<p><?php echo date("l, j F Y", strtotime($info->released)); ?></p>
			</div>
			<div class="col-4 features-box">
				<h5 class="my-2">Ratings</h5>
				<p><?php echo "Rated: ".$info->rating." / 10"; ?></p>
				<p><?php echo "Users: ".$info->votes." users"; ?></p>
			</div>
			<div class="col-4 features-box">
				<h5 class="my-2">Duration</h5>
				<p><?php echo $info->duration." minutes"; ?></p>
			</div>
		</div>
	</div>
</section>

<section class="py-5">
	<div class="container">
		<div class="row">
			<h1>Film Cast <?php echo Auth::user(); ?></h1>
			@foreach ($cast as $cast_item)
				<div class="col-sm-3 mt-sm-0 my-4">
					<div class="position-relative">
						@isset($cast_item->actor_photo)
							<img src="<?php echo $cast_item->actor_photo; ?>" alt="<?php echo $cast_item->actor_name; ?> Photo" style="display: block; max-width:100%;">
						@endisset

						@empty($cast_item->actor_photo)
							<?php 
							echo "<img src='https://dummyimage.com/480x640/30336b/fff&text=".urlencode($cast_item->actor_name. " Photo")."' alt='".$cast_item->actor_name." Photo' style='display: block; max-width:100%;'>";
							?>
						@endempty
						
						<div class="text-position">
							<?php
								$cast_link = "http://www.pliassas.gr/cinema/public/person/".$cast_item->actor_id;
								echo "<h4><a href='".$cast_link."'>".$cast_item->actor_name."</a></h4>";
								echo "<p>".$cast_item->actor_role."</p>";
							?>
						</div>
					</div>
				</div>
			@endforeach
		</div>
		<div class="row crew directors">
			<h1>Film Directors</h1>
			@foreach ($crew['directors'] as $crew_item)
				<div class="col-sm-3 mt-sm-0 my-4">
					<div class="position-relative">
						@isset($crew_item->director_photo)
							<img src="<?php echo $crew_item->director_photo; ?>" alt="<?php echo $crew_item->director_name; ?> Photo" style="display: block; max-width:100%;">
						@endisset

						@empty($crew_item->director_photo)
							<?php 
								echo "<img src='https://dummyimage.com/480x640/30336b/fff&text=".urlencode($crew_item->director_name. " Photo")."' alt='".$crew_item->director_name." Photo' style='display: block; max-width:100%;'>";
							?>
						@endempty
						
						<div class="text-position">
							<?php
								$cast_link = "http://www.pliassas.gr/cinema/public/person/".$crew_item->director_id;
								echo "<h4><a href='".$cast_link."'>".$crew_item->director_name."</a></h4>";
								echo "<p>".$crew_item->director_job."</p>";
							?>
						</div>
					</div>
				</div>
			@endforeach
		</div>
		<div class="row crew writers">
			<h1>Film Writers</h1>
			@foreach ($crew['writers'] as $crew_item)
				<div class="col-sm-3 mt-sm-0 my-4">
					<div class="position-relative">
						@isset($crew_item->writer_photo)
							<img src="<?php echo $crew_item->writer_photo; ?>" alt="<?php echo $crew_item->writer_name; ?> Photo" style="display: block; max-width:100%;">
						@endisset

						@empty($crew_item->writer_photo)
							<?php 
								echo "<img src='https://dummyimage.com/480x640/30336b/fff&text=".urlencode($crew_item->writer_name. " Photo")."' alt='".$crew_item->writer_name." Photo' style='display: block; max-width:100%;'>";
							?>
						@endempty
						
						<div class="text-position">
							<?php
								$cast_link = "http://www.pliassas.gr/cinema/public/person/".$crew_item->writer_id;
								echo "<h4><a href='".$cast_link."'>".$crew_item->writer_name."</a></h4>";
								echo "<p>".$crew_item->writer_job."</p>";
							?>
						</div>
					</div>
				</div>
			@endforeach
		</div>

		<div class="row">
			<h1>Recommendations</h1>
			@for ($i = 0; $i < 12; $i++)
				<?php
					$code = base64_encode(openssl_random_pseudo_bytes(24));
					$item = new FilmController(random_int(1, 20));
				?>
				<div class='col-md-4'>
					@include('film.card', ['code' => $code,  'item' => $item->getFilmInfo()])
				</div>
			@endfor
		</div>
	</div>
</section>

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