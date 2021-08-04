@foreach($results as $filmItem)
<a href="http://www.pliassas.gr/cinema/public/film/{{ $filmItem->movie_id }}" class="search-item">
	<figure>
		<img class="img-fluid" src="{{ $filmItem->poster }}" alt="{{ $filmItem->title }} Poster">
	</figure>
</a>
@endforeach