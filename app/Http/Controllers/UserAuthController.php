<?php

namespace App\Http\Controllers;

use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class UserAuthController extends Controller {

	private Builder $query;

	public function login(Request $r) {

		$success = array(
			'verified' => $this->checkCredentials($r),
			'username' => 'ntina23gr',
			'token' => TokenController::create(),
			'database' => false,
		);

		if( !$success['verified']) {
			return redirect('login');
		} else {
			$this->query = DB::table('usercredits')->where('username', $r->get('username'));
			$results = $this->query->first();
		}

		if( is_object($results) ) {

			$salted = $this->make_pass($results->usersalt, $r->input('password'));

			if( password_verify($salted, $results->password) ) {
				$success['username'] = $r->input('username');
				$success['verified'] = true;
			} else {
				return redirect('login');
			}

			$the_session = DB::table('sessions')->where('id', session()->getId() );
			if( $the_session->exists() ) {
				$old_data = array(
					'access' => time(),
					'username' => $r->input('username'),
					'agent' => $r->userAgent(),
					'address' => ip2long($r->ip()),
					'userdata' => json_encode( array('username' => $r->input('username'), 'token' => $success['token']) ),
				);
				$success['database'] = DB::table('sessions')->where('id', session()->getId() )->update($old_data);
			} else {
				$new_data = array(
					'id' => session()->getId(),
					'access' => time(),
					'username' => $r->input('username'),
					'agent' => $r->userAgent(),
					'address' => ip2long($r->ip()),
					'userdata' => json_encode( array('name' => $r->input('username'), 'token'=>$success['token']))
				);
				$success['database'] = DB::table('sessions')->where('username', $r->input('username'))->insert($new_data);
			}
		}

		if ( $success['database'] ) {
			session()->put('name', $r->input('username'));
//			return 'Password success in '.__CLASS__."::".__METHOD__;
			return view('profile', [ 'username' => $r->input('username') ] );
		} else {
			// return 'Password error in '.__CLASS__."::".__METHOD__';
			return redirect('login');
		}
	}

	private function checkCredentials(Request $r): bool {
		$r->validate([
			'username'  => 'required',
			'password'  => 'required',
		]);
		return true;
	}

	public function profile(Request $req) {
		if( session()->has('name') ) {
			return view('profile', [ 'username' => $req->session()->get('name')]);
		} else {
			return redirect('login');
		}
	}

	public function logout() {
		// return array('exists' => session()->has('name') );
		if( session()->has('name') ) {
			// session()->pull('name');

			$this->query = DB::table('sessions')->select()->where('username', session()->get('name'))->where('id', session()->getId());
			if( $this->query->first() ) {
				// return $this->query->first();
				DB::table('sessions')->where('username', session()->get('name'))->where('id', session()->getId() )->delete();
			}

			session()->pull('name');

			return redirect('login');
		}
		return array('session' => session()->getId(), 'who' => session()->get('name') );
	}

	private function make_pass($salt, $pass): string {
		$one = substr($salt, 0, strlen($salt) / 2);
		$two = substr($salt, strlen($salt) / 2, strlen($salt));
		return $one.$pass.$two;
	}
}
