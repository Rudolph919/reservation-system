<?php

namespace Database\Seeders;

use App\Models\AvailabilityStatus;
use Illuminate\Database\Seeder;

class AvailabilityStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $availabilityStatuses = [
            [
                'name' => 'Available',
            ],
            [
                'name' => 'Not Available',
            ],
            [
                'name' => 'Pending',
            ],
            [
                'name' => 'Out of Service',
            ],
            [
                'name' => 'Closed',
            ],
        ];

        foreach ($availabilityStatuses as $availabilityStatus) {
            AvailabilityStatus::create($availabilityStatus);
        }
    }
}
