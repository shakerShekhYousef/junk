<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRatingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_ratings', function (Blueprint $table) {
            $table->id();
            $table->integer('memeber_id');
            $table->string('service_rate')->nullable(true);
            $table->string('specialization_in_our_service')->nullable(true);
            $table->string('is_your_elements_accurately_found')->nullable(true);
            $table->string('did_you_need_customers_service')->nullable(true);
            $table->string('comments')->nullable(true);
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
        Schema::dropIfExists('service_ratings');
    }
}
