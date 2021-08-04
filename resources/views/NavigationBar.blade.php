<nav class="navbar navbar-expand-sm navbar-style">
	<div class="container-fluid">
		<a class="navbar-brand" href="http://www.pliassas.gr/cinema/public/index.php">Film Database</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample03" aria-controls="navbarsExample03" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse">
			<ul class="navbar-nav me-auto mb-2 mb-sm-0">
				<li class="nav-item"><a class="nav-link active" href="http://www.pliassas.gr/cinema/public/index.php">Home</a></li>
				<li class="nav-item"><a class="nav-link" href="http://www.pliassas.gr/cinema/public/browse">Browse</a></li>
				<li class="nav-item"><a class="nav-link" href="http://www.pliassas.gr/cinema/public/recent">Latest</a></li>
				<li class="nav-item"><a class="nav-link" href="http://www.pliassas.gr/cinema/public/upcoming">Upcoming</a></li>
				<li class="nav-item"><a class="nav-link" href="http://www.pliassas.gr/cinema/public/tv">TV Series</a></li>
			</ul>
			<ul class="navbar-nav">
				<?php
					if( session()->has('name') ) {
						echo "<li class='nav-item'><a class='nav-link' href='http://www.pliassas.gr/cinema/public/profile'>".session()->get('name')."</a></li>\n";
						echo "<li class='nav-item'><a class='nav-link' href='http://www.pliassas.gr/cinema/public/logout'>Logout</a></li>\n";
					} else {
						echo "<li class='nav-item'><a class='nav-link' href='http://www.pliassas.gr/cinema/public/login'>Login</a></li>\n";
						echo "<li class='nav-item'><a class='nav-link' href='http://www.pliassas.gr/cinema/public/register'>Register</a></li>\n";
					}
				?>
			</ul>
		</div>
		<div class="search-right">
			<a href="#search" class="btn search-hny mr-lg-3 mt-lg-0 mt-4" title="search">Search <span class="fa fa-search ml-3" aria-hidden="true"></span></a>
			<!-- search popup -->
			<div id="search" class="pop-overlay">
				<div class="popup">
					<form class="search-box" id="search-film">
						<input type="search" placeholder="Search your Keyword" name="search" id="search-item" required autofocus />
						<button type="submit" class="btn"><span class="fa fa-search" aria-hidden="true"></span></button>
					</form>
					<div class="search-list" id="items">
						<a href="single.php?m=1" class="search-item"><figure><img class="img-fluid" src="http://image.tmdb.org/t/p/original/p3OvQFa5lhbwSAhPygwnlugie1d.jpg" alt="Film Title Here"></figure></a>
						<a href="single.php?m=2" class="search-item"><figure><img class="img-fluid" src="http://image.tmdb.org/t/p/original/eteQ3gyMpA0oiWcYX4XoXGry0cB.jpg" alt="Film Title Here"></figure></a>
						<a href="single.php?m=3" class="search-item"><figure><img class="img-fluid" src="http://image.tmdb.org/t/p/original/8xmzSn5Qd3lX9iqrkoY27wMRE3O.jpg" alt="Film Title Here"></figure></a>
					</div>

					<div class="browse-items">
						<a href="browse" class="search-browse mt-md-5 mt-4">Browse all</a>
						<ul class="search-items">
							@foreach($genres as $genre)
								<li><a href="genre/{{ $genre->genre_name }}">{{ $genre->genre_name }}</a></li>
							@endforeach
						</ul>
					</div>
				</div>
				<a class="close" href="#close">×</a>
			<!-- search popup -->
			</div>
		</div>
		<!-- search-right -->
	</div>
  </nav>