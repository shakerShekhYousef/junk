<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFreezValueForPackagesMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('packages_members', function (Blueprint $table) {
            $table->integer('freeze_value')->default(0);
            $table->string('freeze_start_date')->nullable(false);
            $table->boolean('freeze_approved')->default(false);
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->integer('package_member_id')->default(0);
            $table->string('order_type')->nullable(false);
        });
        Schema::table('fees', function (Blueprint $table) {
            $table->string('fee_status')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('packages_members', function (Blueprint $table) {
            $table->dropColumn('package_member_id');
            $table->dropColumn('order_type');
        });
        Schema::table('fees', function (Blueprint $table) {
            $table->dropColumn('fee_status');
        });
        Schema::table('packages_members', function (Blueprint $table) {
            $table->dropColumn('freeze_value');
            $table->dropColumn('freeze_start_date');
            $table->dropColumn('freeze_approved');
        });
    }
}
