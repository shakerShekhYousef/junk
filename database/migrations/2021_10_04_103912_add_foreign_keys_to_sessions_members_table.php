<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSessionsMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('sessions_members', function(Blueprint $table)
		{
			$table->foreign('session_id')->references('id')->on('sessions')->onUpdate('no action')->onDelete('no action');
			$table->foreign('member_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sessions_members', function(Blueprint $table)
		{
			$table->dropForeign('fk_sessions_members_sessions1');
			$table->dropForeign('fk_sessions_members_sessions2');
		});
	}

}
