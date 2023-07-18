<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToMemberSessionDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('member_session_data', function(Blueprint $table)
		{
			$table->foreign('member_id')->references('id')->on('users')->onUpdate('no action')->onDelete('no action');
			$table->foreign('session_id')->references('id')->on('sessions')->onUpdate('no action')->onDelete('no action');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('member_session_data', function(Blueprint $table)
		{
			$table->dropForeign('member_session_data_fk_1');
			$table->dropForeign('member_session_data_fk_2');
		});
	}

}
