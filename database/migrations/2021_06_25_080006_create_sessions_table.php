<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if (!Schema::hasTable('cinema_sessions')) {
			Schema::create('cinema_sessions', function ($table) {
				$table->string('session_id')->primary();
				$table->foreign('user_id')->references('user_id')->on('userinfo');
				$table->integer('ip_address')->unsigned()->nullable();
				$table->text('user_agent')->nullable();
				$table->text('payload');
				$table->integer('last_activity')->index();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cinema_sessions');
	}
}
