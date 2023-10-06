<?php

namespace Database\Seeders;

use App\Models\BookingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookingStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bookingStatuses  = [
            [
                'name' => 'Pending',
            ],
            [
                'name' => 'Confirmed',
            ],
            [
                'name' => 'Checked In',
            ],
            [
                'name' => 'Checked Out',
            ],
            [
                'name' => 'Completed',
            ],
            [
                'name' => 'Cancelled',
            ],
            [
                'name' => 'No Show',
            ],
        ];

        foreach ($bookingStatuses as $bookingStatus) {
            BookingStatus::create($bookingStatus);
        }
    }
}
