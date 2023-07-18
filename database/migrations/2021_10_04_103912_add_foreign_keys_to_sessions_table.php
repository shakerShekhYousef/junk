<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSessionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::disableForeignKeyConstraints();
        Schema::table('sessions', function(Blueprint $table)
		{
			$table->foreign('class_id')->references('id')->on('classes')->onUpdate('no action')->onDelete('no action');
            $table->foreign('music_id')->references('id')->on('music')->onUpdate('no action')->onDelete('no action');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('sessions', function(Blueprint $table)
		{
			$table->dropForeign('fk_sessions_classes');
		});
	}

}
