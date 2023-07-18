<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('packages', function(Blueprint $table)
		{
			$table->id();
			$table->text('name')->nullable();
			$table->double('cost')->nullable();
			$table->string('cost_type')->nullable(true);
			$table->string('valid_for_type', 45)->nullable(true);
			$table->integer('valid_for_value')->nullable();
			$table->longText('image')->nullable(true);
			$table->longText('barcode')->nullable(true);
			$table->string('sku')->nullable(true);
			$table->string('type')->nullable(true);
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
		Schema::drop('packages');
	}

}
