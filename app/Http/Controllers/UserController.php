<?php
	namespace App\Http\Controllers;
	
	use Illuminate\Database\Query\Builder;
	use Illuminate\Http\JsonResponse;
	use Illuminate\Http\Request;
	use Illuminate\Support\Collection;
	use Illuminate\Support\Facades\DB;
	
	
	class UserController extends Controller {

	private Builder $query;
	private array $options;
	private Collection $results;

	public function __construct() {
		$this->query = DB::table('userinfo')->select()->where('username', 'ntina23gr');
		$this->options = array();
		$this->results = new Collection();
	}

	public function viewUser($id): string {
		return "Hello From UserController for user #".$id;
//		return $r->all();
	}
	
	public function saveUser(Request $request): JsonResponse {
		$array = DB::table('userinfo')->select()->where('username', $request->username)->first();
		return response()->json(['data'=>'User created', 'response' => $array], 200);
	}

	public function userInfo(Request $request, $name): Collection {
	    return DB::table('userinfo')
			->join('usercredits', 'userinfo.username', '=', 'usercredits.username')
			->select('userinfo.*')
			->where('usercredits.username', $name)
			->get();
	}

	public function login(Request $req) {
		if( session()->has('name') ) {
            return view('profile', [ 'username' => $req->session()->get('name')]);
        } else {
            return view('auth.login');
        }
	}

}
