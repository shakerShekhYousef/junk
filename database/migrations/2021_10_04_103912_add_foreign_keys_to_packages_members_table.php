<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPackagesMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('packages_members', function(Blueprint $table)
		{
			$table->foreign('package_id')->references('id')->on('packages')->onUpdate('no action')->onDelete('no action');
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
		Schema::table('packages_members', function(Blueprint $table)
		{
			$table->dropForeign('packages_members_fk_1');
			$table->dropForeign('packages_members_fk_2');
		});
	}

}
