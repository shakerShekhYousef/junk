<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books_history', function (Blueprint $table) {
            $table->id();
			$table->integer('class_id')->nullable();
			$table->integer('session_id')->nullable();
			$table->bigInteger('member_id')->unsigned()->index();
			$table->string('status', 45)->nullable();
			$table->string('description')->nullable(true);
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
        Schema::dropIfExists('books_history');
    }
}
