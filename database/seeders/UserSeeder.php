<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'Rudolph',
                'last_name' => 'Scheepers-White',
                'email' => 'white.rudi@gmail.com',
                'phone_number' => '0796911583',
                'password' => bcrypt('secret99'),
            ],
            [
                'first_name' => 'Elmereth',
                'last_name' => 'Scheepers-White',
                'email' => 'elmereths@gmail.com',
                'phone_number' => '0825783159',
                'password' => bcrypt('secret99'),
            ],

        ];

        foreach ($users as $user) {
            User::create($user);
        }

        User::factory()->count(20)->create();
    }
}
