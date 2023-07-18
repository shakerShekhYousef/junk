<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sessions', function (Blueprint $table) {
			$table->id();
			$table->bigInteger('class_id')->unsigned()->index();
            $table->bigInteger('music_id')->unsigned()->index();
			$table->string('start_time', 45)->nullable();
			$table->string('end_time', 45)->nullable();
			$table->integer('capacity')->nullable();
			$table->bigInteger('coach_id')->unsigned()->index();
			$table->string('status')->nullable();
			$table->string('recurring_type', 45)->nullable();
			$table->string('recuring_interval')->nullable();
			$table->integer('session_total_count')->nullable();
			$table->string('minimum_open_type', 45)->nullable();
			$table->string('minimum_open_value', 45)->nullable();
			$table->string('open_date', 100)->nullable();
			$table->longText('qrcode')->nullable(true);
			$table->double('session_cost')->nullable(true);
			$table->double('total_cost')->nullable(true);
			$table->boolean('isfull')->default(false);
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
		Schema::drop('sessions');
	}
}
