<script setup>
const props = defineProps({
    booking: {
        type: Object,
    },
});
</script>

<template>
    <div class="flex">
        <div class="bg-white shadow-lg rounded-lg p-4 m-2 w-96">
            <!-- Booking Title -->
            <div class="text-xl font-semibold mb-2">
                {{ booking.guest_name }}
            </div>

            <!-- Resource Name -->
            <div class="flex justify-between mb-2">
                <div class="text-gray-600">Resource Name:</div>
                <div class="text-gray-900">{{ booking.resource.name }}</div>
            </div>

            <!-- Booking Status -->
            <div class="flex justify-between mb-2">
                <div class="text-gray-600">Booking Status:</div>
                <div class="text-gray-900">{{ booking.bookingStatus.name }}</div>
            </div>

            <!-- Check-in and Check-out Dates -->
            <div class="flex justify-between mb-2">
                <div class="text-gray-600">Check-in:</div>
                <div class="text-gray-900">{{ booking.check_in_date }}</div>
            </div>

            <div class="flex justify-between mb-2">
                <div class="text-gray-600">Check-out:</div>
                <div class="text-gray-900">{{ booking.check_out_date }}</div>
            </div>

            <!-- Total Price -->
            <div class="flex justify-between">
                <div class="text-gray-600">Total Price:</div>
                <div class="text-gray-900">R {{ booking.total_price }}</div>
            </div>
        </div>
    </div>
</template>
