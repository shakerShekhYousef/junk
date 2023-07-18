<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsMembersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sessions_members', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('member_id')->unsigned()->index();
			$table->bigInteger('session_id')->unsigned()->index();
			$table->integer('role_id');
			$table->timestamps();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sessions_members');
	}
}
