<script setup>
import UnauthenticatedLayoutVue from "@/Layouts/UnauthenticatedLayout.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import { useForm, Head, router } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";
import Booking from "@/Components/Booking.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    resourceTypes: Object,
    filteredBookings: Object,
    error:  String,
});

const form = useForm({
    'checkInDate': '',
    'checkOutDate': '',
    'selectedResourceType': '',
});


const searchBookings = async () => {

    const searchCriteria = {
        checkInDate: form.checkInDate,
        checkOutDate: form.checkOutDate,
        selectedResourceType: form.selectedResourceType,
    };

    router.post('/booking/search', { form }, { preserveState: true });
};
</script>

<template>
    <Head>
        <title>{{ $page.props.title }}</title>
    </Head>

    <UnauthenticatedLayoutVue>
        <section class="py-16">
            <div class="container mx-auto px-4">
                <!-- Search Form -->
                <form @submit.prevent="searchBookings">
                    <div class="flex justify-between">
                        <input
                            type="date"
                            v-model="form.checkInDate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-5"
                        />

                        <span class="p-4">To</span>

                        <input
                            type="date"
                            v-model="form.checkOutDate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-md rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-5"
                        />
                    </div>

                    <InputError class="mt-2" :message="$page.props.error" />

                    <select
                        name="selectedResourceType"
                        v-model="form.selectedResourceType"
                        class="mt-1 border border-gray-300 text-gray-600 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                    >
                        <option selected value="">
                            Select a resource type
                        </option>
                        <option
                            v-for="option in resourceTypes"
                            :value="option.id"
                        >
                            {{ option.name }}
                        </option>
                    </select>

                    <PrimaryButton class="mt-4">Search</PrimaryButton>
                </form>

                <!-- Display Filtered Bookings -->
                <div v-if="filteredBookings">
                    <template v-if="filteredBookings.data && filteredBookings.data.length > 0">
                        <div v-for="booking in filteredBookings.data" :key="booking.id">
                            <Booking :booking="booking" />
                        </div>
                        <Pagination class="mt-6" :links="filteredBookings.links" />
                    </template>
                    <template v-else>
                        <span>
                            There are no bookings that match the search criteria.
                        </span>
                    </template>
                </div>


            </div>
        </section>
    </UnauthenticatedLayoutVue>
</template>
