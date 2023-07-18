<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('requests', function(Blueprint $table)
		{
			$table->id();
			$table->string('type', 45)->nullable();
			$table->text('body')->nullable();
			$table->bigInteger('member_id')->unsigned()->index();
			$table->text('approved_by')->nullable();
			$table->text('status')->nullable();
			$table->text('session_id')->nullable(true);
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
		Schema::drop('requests');
	}

}
