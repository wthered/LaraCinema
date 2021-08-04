<?php

namespace App\Extentions;

class MyCustomSessionHandler extends \SessionHandlerInterface {

	public function open($savePath, $sessionName) {
		return true;
	}

	public function close() {
		// code...
	}

	public function read($sessionId) {
		return json_encode(array('username' => 'ntina23gr'));
	}

	public function write($sessionId, $data) {
		return $data;
	}

	public function destroy($sessionId) {
		// code...
	}

	public function gc($lifetime) {
		// code...
	}
}