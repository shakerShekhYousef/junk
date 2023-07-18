<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function(Blueprint $table)
		{
			$table->id();
			$table->string('payment_type', 45)->nullable();
			$table->integer('payment_type_id')->nullable();
			$table->float('payment_value', 10, 0)->nullable();
			$table->float('total_amount', 10, 0)->nullable();
			$table->bigInteger('member_id')->unsigned()->index();
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
