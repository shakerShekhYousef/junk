<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_setting')->insert([
            'merchant_id'=>'48593',
            'working_key'=>'9C261E16D9AD3BF7E11D5741A345647C',
            'Access_code'=>'AVNV03IH87CM60VNMC',
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now()

        ]);
    }
}
