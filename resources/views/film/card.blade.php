<div class='card'>
	@if(empty($item->backdrop))
		<div class="img_one"><img src="https://placekitten.com/1024/768" style="opacity:0" alt="{{ $item->title }} Photo"></div>
	@else
		<div class="img_one"><img src="{{ $item->backdrop }}" alt="{{ $item->title }} Photo"></div>
	@endif
	<div class="img_two"><img src="{{ $item->poster }}" alt="{{ $item->title }} Poster"></div>
	<div class="main-text">
		<?php
			echo "<a href='http://www.pliassas.gr/cinema/public/film/".$item->movie_id."' class='film-link'><h2>".$item->title."</h2></a>";
			echo "<p>".$item->plot."</p>";
		?>
	</div>
</div>