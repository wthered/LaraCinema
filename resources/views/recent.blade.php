<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="utf-8">
	<title>Recent Movies</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
	<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/search.css')}}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/footer.css')}}">
	<meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>

@include('NavigationBar')

<div class="container">
	<div class="row">
		<h1 style="text-align: center; margin-top: 1rem; margin-bottom: 1rem;">Recent Film List</h1>
		<div class="col-md-3">
			<div class="row filter-box">
				<h1 style="text-align: center">Filter By Genre</h1>
				<ul>
					@foreach($genres as $genre)
						<li><label><input type="checkbox" value="{{ $genre->genre_id }}" name="genre"> {{ $genre->genre_name }}</label></li>
					@endforeach
				</ul>
			</div>
			<div class="row filter-box">
				<h1>Date Released</h1>
				<div class="row">
					<label for="film_date_one" class="col-sm-3 col-form-label">From</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="film_date_one">
					</div>
				</div>
				<div class="row my-3">
					<label for="film_date_two" class="col-sm-3 col-form-label">Until</label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="film_date_two">
					</div>
				</div>
				<button type="button" class="btn btn-outline-info" id="btn-date-range">Refresh</button>
			</div>
			<div class="row filter-box">
				<h1><label for="amount">Rating:</label></h1>
				<input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
				<div class="row">
					<div id="slider-range"></div>
				</div>
			</div>
			<div class="row filter-box"><h1>Filter by Duration</h1></div>
		</div>
		<div class="col-md-9" id="results">
			@include('recent_right', [ 'code' => 'filmCodeHere', 'film_list' => $film_list ] )		
		</div>
	</div>
</div>

@include('footer')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
	$(document).ready(function() {
		const slider_item = $("#slider-range");

		const today = new Date();
		const this_yr = today.getFullYear();
		const this_mn = today.getMonth() + 1;
		const this_dt = today.getDate();

		$("#film_date_one").val('1930-01-01');
		$("#film_date_two").val('' + this_yr + '-' + this_mn + '-' + this_dt);
		console.log($("#film_date_two").val());

		$("input[name='genre']").click(function() {
			const favorite = [];
			$.each($("input[name='genre']:checked"), function(){
				favorite.push($(this).val());
			});

			let post_data = {
				'genres': favorite,
					'_token': document.querySelector('meta[name="csrf-token"]').content,
					'date_source': $("#film_date_one").val(),
					'date_target': $("#film_date_two").val(),
			};

			$.post( "ajaxGenres", post_data )
				.done( data => {
					$( "#results" ).html( data );
				})
				.fail(suck => {
					console.error( suck );
				});
		});

	    slider_item.slider({
			    range: true,
			    min: 0,
			    max: 10,
			    values: [ 0, 10 ],
			    step: 0.5,
			    slide: function( event, ui ) {
			    	$( "#amount" ).val( " " + ui.values[ 0 ] + " - " + ui.values[ 1 ] );
			    }
	    });
	    $( "#amount" ).val( "$" + slider_item.slider( "values", 0 ) + " - $" + slider_item.slider( "values", 1 ) );
	});
</script>

</body>
</html>