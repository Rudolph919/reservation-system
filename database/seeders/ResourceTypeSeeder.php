<?php

namespace Database\Seeders;

use App\Models\ResourceType;
use Illuminate\Database\Seeder;

class ResourceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resourceTypes = [
            [
                'name' => 'Hotel Room',
            ],
            [
                'name' => 'Safari Lodge',
            ],
            [
                'name' => 'Vacation Rental',
            ],
            [
                'name' => 'AirBnB',
            ],
            [
                'name' => 'Hostel',
            ],
            [
                'name' => 'Camping Site',
            ],
            [
                'name' => 'RV Park',
            ],
        ];

        foreach ($resourceTypes as $resourceType) {
            ResourceType::create($resourceType);
        }
    }
}
