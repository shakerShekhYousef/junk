<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSessionCustomizeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('session_customize', function(Blueprint $table)
		{
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
		Schema::table('session_customize', function(Blueprint $table)
		{
			$table->dropForeign('fk_session_customize_sessions1');
		});
	}

}
