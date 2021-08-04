<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TokenController extends Controller {
 
	private array $options;

	public function __construct() {
		$this->options = array();
	}

	public static function create(): string {
		try {
			return base64_encode(random_bytes(24));
		} catch (Exception $e) {
			error_log("[".__CLASS__."::".__METHOD__."] ".$e->getTraceAsString());
			return base64_encode(openssl_random_pseudo_bytes(24));
		}
	}

	private function exists(Request $request): Collection {
		return DB::table('sessions')
			->where('id', $request->token)
			->where('username', $request->username)
			->get();
	}

	public function handle(Request $r): array {
		$exists = $this->exists($r);
		if(count($exists) == 1) {
			$this->options = array(
				'access' => time(),
				'userdata' => $this->create(),
				'agent' => $r->userAgent(),
				'address' => ip2long($r->ip())
			);
			$result = DB::table('sessions')->where(array('id' => $r->token, 'username' => $r->username))->update($this->options);
			return array(
				'exists' => $exists,
				'info' => $this->getUserInfo($r->username),
				'result' => $result,
				'auth' => !hash_equals('ntina23gr', $r->username)
			);
		} else {
			$this->options = array(
				'id' => $this->create(),
				'access' => time(),
				'username' => $r->username,
				'agent' => $r->userAgent(),
				'address' => ip2long($r->ip()),
				'userdata' => $this->create()
			);
			$result = DB::table('sessions')->insert($this->options);
			return array('exists' => $exists, 'info' => $this->getUserInfo($r->username), 'result' => $result, 'auth' => !hash_equals('ntina23gr', $r->username));
		}
	}
	
	private function getUserInfo($username) {
		return DB::table('userinfo')->where('username', $username)->first();
	}
}
