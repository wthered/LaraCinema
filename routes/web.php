<?php
	
	use App\Http\Controllers\FilmController;
	use App\Http\Controllers\UserController;
	use App\Http\Controllers\UserAuthController;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

	Route::get('/', function () {
		$main_list = [
			'filmList' => FilmController::listAll(),
			'latestFilms' => FilmController::getLatest(),
			'popularFilms' => FilmController::getPopular()
		];
		return view('hello', $main_list);
	});
	
	Route::get('/recent', function () {
		return view('recent', [
			'film_list' => FilmController::getLatest(),
			'genres'    => FilmController::getGenreList(),
		]);
	});

	Route::get('/browse', function () {
		return view('browse');
	});

	Route::get('/upcoming', function() {
		return view('upcoming');
	});

	Route::get('/tv', function() {
		return view('tv');
	});
	
	Route::get('/user/{name}', function (Request $r, $name) {
		$user = new UserController();
		return view('user', ['info' => $user->userInfo($r, $name)]);
	});

	Route::get('/person/{id}', function(Request $r, $id) {
		return view('person', ['person' => $id]);
	});

	Route::get('/film/{id}', function(Request $r, $id) {
		$movie = new FilmController($id);
		$filmView = array(
			'info'	=> $movie->getFilmInfo(),
			'cast'	=> $movie->getFilmCast(),
			'crew'	=> $movie->getFilmCrew(),
			'genres'=> $movie->getGenreFilm(),
		);
		if( !is_null($filmView['info']) ) {
			return view('movie', $filmView );
		}
		return response('Film Not Found', 404)->header('Content-Type', 'text/plain');
	})->where('id', '[0-9]{1,6}');

	Route::get('/login', [ UserController::class, 'login' ]);

	Route::post('check', [ UserAuthController::class, 'login' ]);

	Route::get('/register', function() {
		return view('auth.register');
	});

	Route::get('profile', [ UserAuthController::class, 'profile' ]);

	Route::get('logout', [ UserAuthController::class, 'logout' ]);
	
	Route::post('ajaxGenres', function(Request $r) {
		return FilmController::ajaxPostGenres($r->input('genres'), $r->get('date_source'), $r->get('date_target'));
	});
