<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->id();
			$table->string('email', 45)->nullable();
			$table->string('fname', 45)->nullable(true);
			$table->string('lname', 45)->nullable(true);
			$table->string('gender', 45)->nullable(true);
			$table->string('screen_name', 100)->nullable(true);
			$table->string('dob', 45)->nullable(true);
			$table->integer('age')->nullable(true);
			$table->integer('height')->nullable(true);
			$table->integer('weight')->nullable(true);
			$table->string('address1', 200)->nullable(true);
			$table->string('address2', 200)->nullable(true);
			$table->string('city', 45)->nullable(true);
			$table->string('state', 45)->nullable(true);
			$table->string('zip_code', 45)->nullable(true);
			$table->string('country', 45)->nullable(true);
			$table->string('phone', 45)->nullable(true);
			$table->string('whats_app_phone', 45)->nullable(true);
			$table->string('referred_by', 100)->nullable(true);
			$table->string('emergency_contact_name', 100)->nullable(true);
			$table->string('emergency_contact_number', 100)->nullable(true);
			$table->string('emergency_contact_relation', 100)->nullable(true);
			$table->boolean('tc_agree', 100)->default(true);
			$table->integer('role_id')->nullable();
			$table->timestamp('email_verified_at')->nullable();
			$table->string('password');
			$table->boolean('firstclass')->default(true);
			$table->rememberToken();
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
		Schema::drop('users');
	}
}
