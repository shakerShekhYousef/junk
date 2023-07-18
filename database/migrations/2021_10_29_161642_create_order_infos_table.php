<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->nullable(true);
            $table->string('tracking_id')->nullable(true);
            $table->string('payment_mode')->nullable(true);
            $table->string('card_name')->nullable(true);
            $table->string('billing_name')->nullable(true);
            $table->string('billing_address')->nullable(true);
            $table->string('billing_city')->nullable(true);
            $table->string('billing_state')->nullable(true);
            $table->string('billing_zip')->nullable(true);
            $table->string('billing_country')->nullable(true);
            $table->string('billing_tel')->nullable(true);
            $table->string('billing_email')->nullable(true);
            $table->string('delivery_name')->nullable(true);
            $table->string('delivery_address')->nullable(true);
            $table->string('delivery_city')->nullable(true);
            $table->string('delivery_state')->nullable(true);
            $table->string('delivery_zip')->nullable(true);
            $table->string('delivery_country')->nullable(true);
            $table->string('delivery_tel')->nullable(true);
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
        Schema::dropIfExists('order_infos');
    }
}
