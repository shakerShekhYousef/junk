<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPackagesSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('packages_sessions', function(Blueprint $table)
		{
			// $table->foreign('session_id')->references('id')->on('sessions')->onUpdate('no action')->onDelete('no action');
			// $table->foreign('package_id')->references('id')->on('packages')->onUpdate('no action')->onDelete('no action');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('packages_sessions', function(Blueprint $table)
		{
			// $table->dropForeign('packages_sessions_fk_1');
			// $table->dropForeign('packages_sessions_fk_2');
		});
	}

}
