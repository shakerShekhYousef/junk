<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberSessionDataTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('member_session_data', function(Blueprint $table)
		{
			$table->id();
			$table->bigInteger('member_id')->unsigned()->index();
			$table->bigInteger('session_id')->unsigned()->index();
			$table->dateTime('date_of_session')->nullable();
			$table->boolean('attended')->nullable();
			$table->string('day_name')->nullable();
			$table->string('start_at')->nullable(true);
			$table->string('end_at')->nullable(true);
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
		Schema::drop('member_session_data');
	}

}
