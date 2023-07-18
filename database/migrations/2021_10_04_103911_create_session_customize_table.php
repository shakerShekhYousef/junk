<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionCustomizeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('session_customize', function(Blueprint $table)
		{
			$table->id();
			$table->bigInteger('session_id')->unsigned()->index();
			$table->string('member_id', 45)->nullable();
			$table->string('music_type', 45)->nullable();
			$table->text('music_list')->nullable();
			$table->text('location')->nullable();
			$table->text('other')->nullable();
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
		Schema::drop('session_customize');
	}

}
