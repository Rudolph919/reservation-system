<?php

namespace Database\Seeders;

use App\Models\AddOn;
use Illuminate\Database\Seeder;

class AddOnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $AddOns = [
            [
                'name' => 'Bed & Breakfast',
                'description' => 'The resource booked includes a breakfast served the following morning. Breakfast consists of either muesli and yogurt or an egg, bacon and toast breakfast.',
                'price' => '70.00'
            ],
            [
                'name' => 'Champagne',
                'description' => 'The resource booked includes a chilled bottle of champagne.',
                'price' => '250.00'
            ],
            [
                'name' => 'Rose Petals',
                'description' => 'The room booked includes a generous showering of rose petals on the floor and bed creating a romantic atmosphere.',
                'price' => '100.00'
            ],
            [
                'name' => 'Extension Cord',
                'description' => 'The resource booked includes an extension cord.',
                'price' => '30.00'
            ],
            [
                'name' => 'Potjie Kos Pot and Stand',
                'description' => 'The resource booked includes a potjie kos pot and stand.',
                'price' => '50.00'
            ],
        ];

        foreach ($AddOns as $addOn) {
            AddOn::create($addOn);
        }
    }
}
