<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesMembersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('packages_members', function(Blueprint $table)
		{
			$table->id();
			$table->bigInteger('package_id')->unsigned()->index();
			$table->bigInteger('member_id')->unsigned()->index();
			$table->dateTime('valid_till')->nullable();
			$table->string('purchase_status', 45)->nullable();
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
		Schema::drop('packages_members');
	}

}
