<?php

namespace Database\Seeders;

use App\Models\Package;
use Illuminate\Database\Seeder;

class PackagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // free package
        $sku = 335267555979;
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($sku, $generator::TYPE_CODE_128));
        $package = Package::updateOrCreate([
            'name' => '1st_class_free'
        ], [
            'name' => '1st_class_free',
            'cost' => 0,
            'cost_type' => 'AED',
            'valid_for_type' => 'Year',
            'valid_for_value' => 10,
            'image' => 'packages/1Free.jpg',
            'sku' => $sku,
            'barcode' => $barcode,
            // 'type' => 8,
            'sessions_count' => 1
        ]);

        // 1 session valid for 30 days
        $sku = 102423575671;
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($sku, $generator::TYPE_CODE_128));
        $package = Package::updateOrCreate([
            'name' => '1_class_pass'
        ], [
            'name' => '1_class_pass',
            'cost' => 120,
            'cost_type' => 'AED',
            'valid_for_type' => 'Day',
            'valid_for_value' => 30,
            'image' => 'packages/1Class.jpg',
            'sku' => $sku,
            'barcode' => $barcode,
            // 'type' => 1,
            'sessions_count' => 1
        ]);
        if ($package->wasRecentlyCreated)
            $package->sessions()->attach([3, 4]);

        // 3 sessions valid for 30 days
        $sku = 335267555972;
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($sku, $generator::TYPE_CODE_128));
        $package = Package::updateOrCreate([
            'name' => '3_class_pass'
        ], [
            'name' => '3_class_pass',
            'cost' => 330,
            'cost_type' => 'AED',
            'valid_for_type' => 'Day',
            'valid_for_value' => 30,
            'image' => 'packages/3Class.jpg',
            'sku' => $sku,
            'barcode' => $barcode,
            // 'type' => 2,
            'sessions_count' => 3
        ]);
        if ($package->wasRecentlyCreated)
            $package->sessions()->attach([7, 8]);

        // 5 sessions valid for 30 days
        $sku = 335267555973;
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($sku, $generator::TYPE_CODE_128));
        $package = Package::updateOrCreate([
            'name' => '5_class_pass'
        ], [
            'name' => '5_class_pass',
            'cost' => 500,
            'cost_type' => 'AED',
            'valid_for_type' => 'Day',
            'valid_for_value' => 30,
            'image' => 'packages/5Class.jpg',
            'sku' => $sku,
            'barcode' => $barcode,
            // 'type' => 3,
            'sessions_count' => 5
        ]);
        if ($package->wasRecentlyCreated)
            $package->sessions()->attach([7, 8]);

        // 30 sessions valid for 30 days 
        // $sku = 213424555674;
        // $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        // $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($sku, $generator::TYPE_CODE_128));
        // $package = Package::updateOrCreate([
        //     'name' => '30_days_challenge'
        // ], [
        //     'name' => '30_days_challenge',
        //     'cost' => 999,
        //     'cost_type' => 'AED',
        //     'valid_for_type' => 'Day',
        //     'valid_for_value' => 30,
        //     'image' => 'packages/1Month.jpg',
        //     'sku' => $sku,
        //     'barcode' => $barcode,
        //     // 'type' => 4,
        //     'sessions_count' => 30
        // ]);
        // if ($package->wasRecentlyCreated)
        //     $package->sessions()->attach([5, 6]);

        // 90 session valid for 3 months
        $sku = 335267555975;
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($sku, $generator::TYPE_CODE_128));
        $package = Package::updateOrCreate([
            'name' => '3_month_pass'
        ], [
            'name' => '3_month_pass',
            'cost' => 2800,
            'cost_type' => 'AED',
            'valid_for_type' => 'Month',
            'valid_for_value' => 3,
            'image' => 'packages/3Month.jpg',
            'sku' => $sku,
            'barcode' => $barcode,
            // 'type' => 5,
            'sessions_count' => 90
        ]);
        if ($package->wasRecentlyCreated)
            $package->sessions()->attach([7, 8]);


        // 180 sessions valid for 6 months
        $sku = 335267555976;
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($sku, $generator::TYPE_CODE_128));
        $package = Package::updateOrCreate([
            'name' => '6_month_pass'
        ], [
            'name' => '6_month_pass',
            'cost' => 5500,
            'cost_type' => 'AED',
            'valid_for_type' => 'Month',
            'valid_for_value' => 6,
            'image' => 'packages/6Month.jpg',
            'sku' => $sku,
            'barcode' => $barcode,
            // 'type' => 6,
            'sessions_count' => 180
        ]);
        if ($package->wasRecentlyCreated)
            $package->sessions()->attach([7, 8]);

        // 360 session valid for 12 month
        $sku = 335267555977;
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($sku, $generator::TYPE_CODE_128));
        $package = Package::updateOrCreate([
            'name' => '12_month_pass'
        ], [
            'name' => '12_month_pass',
            'cost' => 10750,
            'cost_type' => 'AED',
            'valid_for_type' => 'Month',
            'valid_for_value' => 12,
            'image' => 'packages/12Month.jpg',
            'sku' => $sku,
            'barcode' => $barcode,
            // 'type' => 7,
            'sessions_count' => 360
        ]);
        if ($package->wasRecentlyCreated)
            $package->sessions()->attach([7, 8]);

        // 30 sessions valid for 1 year
        $sku = 335267555978;
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
        $barcode = 'data:image/png;base64,' . base64_encode($generator->getBarcode($sku, $generator::TYPE_CODE_128));
        $package = Package::updateOrCreate([
            'name' => '30_class_pass'
        ], [
            'name' => '30_class_pass',
            'cost' => 10750,
            'cost_type' => 'AED',
            'valid_for_type' => 'Year',
            'valid_for_value' => 1,
            'image' => 'packages/30Class.jpg',
            'sku' => $sku,
            'barcode' => $barcode,
            // 'type' => 8,
            'sessions_count' => 30
        ]);
        if ($package->wasRecentlyCreated)
            $package->sessions()->attach([7, 8]);
    }
}
