<script setup>
const props = defineProps({
    booking: {
        type: Object,
    },
});
</script>

<template>
    <div class="flex">
        <div class="p-4 m-2 bg-white rounded-lg shadow-lg w-96">
            <!-- Booking Title -->
            <div class="mb-2 text-xl font-semibold">
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
                <div class="text-gray-900">
                    {{ booking.booking_status.name }}
                </div>
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
