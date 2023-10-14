<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Resource;
use App\Models\BookingStatus;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::all();
        $resources = Resource::all();
        $bookingStatuses = BookingStatus::all();

        $currentDate = Carbon::now();
        $checkInDate = $currentDate->copy()->addDays(rand(1, 90));
        $lengthOfStay = rand(1, 7);
        $checkOutDate = $checkInDate->copy()->addDays($lengthOfStay - 1);


        return [
            'user_id' => $users->random()->id,
            'check_in_date' => $checkInDate,
            'check_out_date' => $checkOutDate,
            'resource_id' => $resources->random()->id,
            'guest_name' => $this->faker->name,
            'guest_email' => $this->faker->email,
            'guest_phone' => $this->faker->phoneNumber,
            'guest_count' => rand(1, 10),
            'booking_status_id' => $bookingStatuses->random()->id,
            'total_price' => $this->faker->randomFloat(2, 50, 500),
        ];

        // return [
        //     'user_id' => $users->random()->id,
        //     'check_in_date' => $this->faker->date,
        //     'check_out_date' => $this->faker->date,
        //     'resource_id' => $resources->random()->id,
        //     'guest_name' => $this->faker->name,
        //     'guest_email' => $this->faker->email,
        //     'guest_phone' => $this->faker->phoneNumber,
        //     'booking_status_id' => $bookingStatuses->random()->id,
        //     'total_price' => $this->faker->randomFloat(2, 50, 500),
        // ];
    }
}
