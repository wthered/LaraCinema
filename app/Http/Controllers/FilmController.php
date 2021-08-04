<?php
	
	namespace App\Http\Controllers;
	
	use Illuminate\Http\Request;
	use Illuminate\Support\Collection;
	use \Illuminate\Support\Facades\DB;
	
	class FilmController extends Controller {

		private int $film_id;

		public function __construct($film_id) {
			// $this->middleware('auth');
			$this->film_id = $film_id;
		}

		public static function listAll(): Collection {
			return DB::table('movies')->limit(12)->get();
		}

		public static function search( $term ) {
			$term = filter_var(strtolower($term), FILTER_SANITIZE_STRING);
			$results = DB::table('movies')->whereRaw('LOWER(title) like (?)',["%{$term}%"])->limit(5)->get();
			return view('film.search', [ 'results' => $results ] );
		}

		public static function getGenreList(): Collection {
			return DB::table('genres')->get();
		}

		// Gets genres of the film
		public function getGenreFilm(): Collection {
			return DB::table('movie_genres')
				->join('genres', 'movie_genres.genre_id', '=', 'genres.genre_id')
				->where('movie_genres.movie_id', '=', $this->film_id)
				->select('movie_genres.genre_id', 'genres.genre_name')
				->get();
		}

		// Gets film list of that genre
		public static function getFilmsGenre($genre): Collection {
			return DB::table('movie_genres')
			->join('genres', 'movie_genres.genre_id', '=', 'genres.genre_id')
			->whereRaw('LOWER(genre_name) = ?',["{$genre}"])
			->select('movie_genres.movie_id')
			->limit(15)
			->get();
		}

		public static function getLatest() {
			$result = DB::table('movies')
				->where('released', '<', date("Y-m-d"))
				->whereNotNull('backdrop')
				->limit(12)
				->orderBy('released', 'desc')
				->get();
			return array('query' => 'select latest films', 'result' => $result);
		}

		public static function getPopular(): array {
			$filmList = [];
			for($film = 0; $film < 12; $film++) {
				$filmItem = new \stdClass();
				$filmItem->movie_id = mt_rand(1, 20);
				$filmItem->title = 'Film ' . $filmItem->movie_id . ' Title';
				$filmItem->poster = 'https://placekitten.com/480/640';
				$filmItem->backdrop = 'https://placekitten.com/768/912';
				$filmItem->plot = 'Lorem Ipsum Hello World Pizza Place ' . base64_encode(openssl_random_pseudo_bytes(9));
				$filmList[$film] = $filmItem;
			}
			return $filmList;
		}

		public function getFilmInfo() {
			$info = DB::table('movies')->where('movie_id', $this->film_id)->first();
			if ( is_object($info) ){
				return $info;
			}
			return null;
		}

		public function getFilmCast(): Collection {
			return DB::table('movie_actors')
			->join('actors', 'actors.actor_id', '=', 'movie_actors.actor_id')
			->where('movie_actors.movie_id', '=', $this->film_id)
			->orderBy('actors.actor_score', 'DESC')
			->get();
		}

		public function getFilmCrew(): array {
			return array(
				'directors' => $this->getMovieDirectors(),
				'writers'	=> $this->getMovieWriters()
			);
		}

		private function getMovieDirectors(): Collection {
			return DB::table('movie_directors')
				->join('movies', 'movies.movie_id', '=', 'movie_directors.movie_id')
				->join('directors', 'directors.director_id', '=', 'movie_directors.director_id')
				->select('movie_directors.director_id', 'movie_directors.director_job', 'directors.director_name', 'directors.director_photo')
				->where('movies.movie_id', $this->film_id)
				->orderBy('directors.director_score', 'DESC')
				->get();
		}

		public static function ajaxPostGenres($genres, $date_one, $date_two) {
			if( empty($genres) ) {
				$latest = FilmController::getLatest();
				return view('film.deck', [ 'film_deck' => $latest['result'] ] );
			}

			$theQuery = "SELECT movie_id, title, plot, poster, backdrop FROM movies WHERE movie_id in (SELECT m.movie_id FROM movie_genres g INNER JOIN movies m ON m.movie_id = g.movie_id WHERE m.released > " . $date_one . " AND m.released < ".$date_two." AND g.genre_id = " . $genres[0];
			if( count($genres) > 1) {
				// toDo: DB::select('SELECT * FROM users WHERE id = ?', [1]);
				for($i = 1; $i < count($genres); $i++) {
					$theQuery .= " AND m.movie_id in (SELECT m.movie_id FROM movie_genres g INNER JOIN movies m ON m.movie_id = g.movie_id WHERE g.genre_id = ".$genres[$i].") ";
				}
			}
			$theQuery .= ") ORDER BY released DESC LIMIT 12";

			$result = DB::select( DB::raw( $theQuery ) );
			if( !empty( $result ) ) {
				return view('film.deck', [ 'query' => $theQuery, 'film_deck' => $result, 'date_one' => $date_one, 'date_two' => $date_two ] );
			} else {
//				return array('query' => $theQuery, 'result' => array() );
				return view('film.deck', [ 'film_deck' => array() ] );
			}
		}

		private function getMovieWriters(): Collection {
			return DB::table('movie_writers')
				->join('movies', 'movies.movie_id', '=', 'movie_writers.movie_id')
				->join('writers', 'writers.writer_id', '=', 'movie_writers.writer_id')
				->select('movie_writers.writer_id', 'movie_writers.writer_job', 'writers.writer_name', 'writers.writer_photo')
				->where('movies.movie_id', $this->film_id)
				->orderBy('writers.writer_score', 'DESC')
				->get();
		}
	}
