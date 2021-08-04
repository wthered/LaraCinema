<div class="row" id="film_head">{{ $query }}</div>
<div class="row">
	@foreach($film_deck as $film_item)
		<div class="col-xs-12 col-sm-6 col-md-4">
			@include('film.card', [ 'item' => $film_item ] )
		</div>
	@endforeach
</div>