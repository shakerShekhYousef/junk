<?php

namespace Database\Seeders;

use App\Models\ClassM;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ClassesSeeder::class);
        $this->call(SessionsSeeder::class);
        $this->call(PackagesSeeder::class);
        $this->call(PaymentSettingsSeeder::class);
        $this->call(MusicTableSeeder::class);
    }
}
