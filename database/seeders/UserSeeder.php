<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // roles list:
        // 1- GM: Gym Manager
        // 2- Crew: Sales Team
        // 3- MC: Coach
        // 4- user

        // 1
        User::updateOrCreate(
            [
                'email' => 'admin@junk-dubai.com'
            ],
            [
                'fname' => 'ali',
                'lname' => 'fouad',
                'email' => "admin@junk-dubai.com",
                'email_verified_at' => now(),
                'dob'=> now()->subYears(39),
                'gender' => '1',
                'password' => Hash::make('12345678'),
                'role_id' => '1'
            ]
        );

        // 2
        User::updateOrCreate(
            [
                'email' => 'sale@junk-dubai.com'
            ],
            [
                'fname' => 'sale',
                'lname' => 'man',
                'email' => "sale@junk-dubai.com",
                'email_verified_at' => now(),
                'gender' => '1',
                'dob'=> now()->subYears(38),
                'password' => Hash::make('12345678'),
                'role_id' => '2'
            ]
        );

        // 3
        User::updateOrCreate(
            [
                'email' => 'Ellie@junk-dubai.com'
            ],
            [
                'fname' => 'Ellie',
                'lname' => '',
                'email' => "Ellie@junk-dubai.com",
                'email_verified_at' => now(),
                'gender' => '1',
                'dob'=> now()->subYears(37),
                'password' => Hash::make('12345678'),
                'role_id' => '3'
            ]
        );

        // 4
        User::updateOrCreate(
            [
                'email' => 'Rasha@junk-dubai.com'
            ],
            [ 
                'fname' => 'Rasha',
                'lname' => '',
                'email' => "Rasha@junk-dubai.com",
                'email_verified_at' => now(),
                'gender' => '2',
                'dob'=> now()->subYears(36),
                'password' => Hash::make('12345678'),
                'role_id' => '3'
            ]
        );

        // 5
        User::updateOrCreate(
            [
                'email' => 'Steve@junk-dubai.com'
            ],
            [        
                'fname' => 'Steve',
                'lname' => '',
                'email' => "Steve@junk-dubai.com",
                'email_verified_at' => now(),
                'gender' => '1',
                'dob'=> now()->subYears(24),
                'password' => Hash::make('12345678'),
                'role_id' => '3'
            ]
        );

        // 6
        User::updateOrCreate(
            [
                'email' => 'Anthony@junk-dubai.com'
            ],
            [        
                'fname' => 'Anthony',
                'lname' => '',
                'email' => "Anthony@junk-dubai.com",
                'email_verified_at' => now(),
                'gender' => '1',
                'dob'=> now()->subYears(25),
                'password' => Hash::make('12345678'),
                'role_id' => '3'
            ]
        );

        // 7
        User::updateOrCreate(
            [
                'email' => 'Beeman@junk-dubai.com'
            ],
            [        
                'fname' => 'Beeman',
                'lname' => '',
                'email' => "Beeman@junk-dubai.com",
                'email_verified_at' => now(),
                'gender' => '1',
                'dob'=> now()->subYears(26),
                'password' => Hash::make('12345678'),
                'role_id' => '3'
            ]
        );

        // 8
        User::updateOrCreate(
            [
                'email' => 'Lucy@junk-dubai.com'
            ],
            [        
                'fname' => 'Lucy',
                'lname' => '',
                'email' => "Lucy@junk-dubai.com",
                'email_verified_at' => now(),
                'gender' => '2',
                'dob'=> now()->subYears(27),
                'password' => Hash::make('12345678'),
                'role_id' => '3'
            ]
        );

        // 9
        User::updateOrCreate(
            [
                'email' => 'Jenny@junk-dubai.com'
            ],
            [        
                'fname' => 'Jenny',
                'lname' => '',
                'email' => "Jenny@junk-dubai.com",
                'email_verified_at' => now(),
                'gender' => '2',
                'dob'=> now()->subYears(28),
                'password' => Hash::make('12345678'),
                'role_id' => '3'
            ]
        );

        // 10
        User::updateOrCreate(
            [
                'email' => 'Sharon@junk-dubai.com'
            ],
            [        
                'fname' => 'Sharon',
                'lname' => '',
                'email' => "Sharon@junk-dubai.com",
                'email_verified_at' => now(),
                'gender' => '2',
                'dob'=> now()->subYears(29),
                'password' => Hash::make('12345678'),
                'role_id' => '3'
            ]
        );

        // 11
        User::updateOrCreate(
            [
                'email' => 'user@junkfitnessclub.com'
            ],
            [
                'fname' => 'user',
                'lname' => 'man',
                'email' => "user@junkfitnessclub.com",
                'email_verified_at' => now(),
                'gender' => '1',
                'dob'=> now()->subYears(30),
                'password' => Hash::make('12345678'),
                'role_id' => '4'
            ]
        );

        // 12
        User::updateOrCreate(
            [
                'email' => 'user1@junkfitnessclub.com'
            ],
            [
                'fname' => 'user',
                'lname' => 'man1',
                'email' => "user1@junkfitnessclub.com",
                'email_verified_at' => now(),
                'gender' => '1',
                'dob'=> now()->subYears(31),
                'password' => Hash::make('12345678'),
                'role_id' => '4'
            ]
        );

        // 13
        User::updateOrCreate(
            [
                'email' => 'user2@junkfitnessclub.com'
            ],
            [
                'fname' => 'user',
                'lname' => 'man2',
                'email' => "user2@junkfitnessclub.com",
                'email_verified_at' => now(),
                'gender' => '1',
                'dob'=> now()->subYears(32),
                'password' => Hash::make('12345678'),
                'role_id' => '4'
            ]
        );

        // 14
        User::updateOrCreate(
            [
                'email' => 'user3@junkfitnessclub.com'
            ],
            [
                'fname' => 'user',
                'lname' => 'man3',
                'email' => "user3@junkfitnessclub.com",
                'email_verified_at' => now(),
                'gender' => '2',
                'dob'=> now()->subYears(33),
                'password' => Hash::make('12345678'),
                'role_id' => '4'
            ]
        );

        // 15
        User::updateOrCreate(
            [
                'email' => 'user4@junkfitnessclub.com'
            ],
            [
                'fname' => 'user',
                'lname' => 'man4',
                'email' => "user4@junkfitnessclub.com",
                'email_verified_at' => now(),
                'gender' => '2',
                'dob'=> now()->subYears(34),
                'password' => Hash::make('12345678'),
                'role_id' => '4'
            ]
        );

        // new admins
                // 16
                User::updateOrCreate(
                    [
                        'email' => 'Dixie@junk-dubai.com'
                    ],
                    [
                        'fname' => 'Dixie',
                        'lname' => 'Dixie',
                        'email' => "Dixie@junk-dubai.com",
                        'email_verified_at' => now(),
                        'dob'=> now()->subYears(39),
                        'gender' => '1',
                        'password' => Hash::make('qSdwCE#$#hg'),
                        'role_id' => '1'
                    ]
                );
                // 17
                User::updateOrCreate(
                    [
                        'email' => 'Lyzette@junk-dubai.com'
                    ],
                    [
                        'fname' => 'Lyzette',
                        'lname' => 'Lyzette',
                        'email' => "Lyzette@junk-dubai.com",
                        'email_verified_at' => now(),
                        'dob'=> now()->subYears(39),
                        'gender' => '1',
                        'password' => Hash::make('zxD2d#e4'),
                        'role_id' => '1'
                    ]
                );
    }
}
