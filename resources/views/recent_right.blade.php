<div class='row' id="film_head">Query Executed: {{ $film_list['query'] }}</div>
<div class='row'>
	@foreach( $film_list['result'] as $film )
		<div class="col-xs-12 col-sm-6 col-md-4">
			@include('film.card', [ 'item' => $film ] )
		</div>
	@endforeach
</div>