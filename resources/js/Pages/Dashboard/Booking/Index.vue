<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import DangerButton from "@/Components/DangerButton.vue";
import NotificationSuccess from "@/Components/NotificationSuccess.vue";
import Pagination from "@/Components/Pagination.vue";
import PrimaryNavLink from "@/Components/PrimaryNavLink.vue";
import SecondaryNavLink from "@/Components/SecondaryNavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import TextInput from "@/Components/TextInput.vue";
import { Head, router, usePage } from "@inertiajs/vue3";
import { ref } from "vue";
import { Inertia } from "@inertiajs/inertia";

defineProps({
    title: {
        type: String,
    },
    data: {
        type: Object,
    },
    success: {
        type: String,
    },
    bookingStatus: {
        type: Object,
    },
});

const destroy = (id) => {
    router.delete(route("booking.destroy", id), {
        onBefore: () =>
            confirm("Are you sure you want to delete this booking?"),
    });
};

const { props } = usePage();

const search = ref(props.search);
const bookingStatusId = ref(props.bookingStatusId);
const checkInDate = ref(props.checkInDate);
const checkOutDate = ref(props.checkOutDate);

const handleSearch = () => {
    Inertia.get(route("booking.index"), {
        search: search.value,
        bookingStatusId: bookingStatusId.value,
        checkInDate: checkInDate.value,
        checkOutDate: checkOutDate.value,
    });
};

const resetSearch = () => {
    search.value = "";
    bookingStatusId.value = "";
    checkInDate.value = "";
    checkOutDate.value = "";
    handleSearch();
};
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <div class="flex justify-center">
            <NotificationSuccess v-if="success" :message="success" />
        </div>

        <div class="py-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="p-4 mb-2 bg-gray-300 rounded-lg shadow-sm">
                    <div class="flex justify-between">
                        <TextInput
                            name="search"
                            v-model="search"
                            type="text"
                            placeholder="Search by Guest Name or Booking Status..."
                            class="block w-full mt-1 text-sm"
                            autofocus
                        />
                        <select
                            name="bookingStatus"
                            v-model="bookingStatusId"
                            class="block w-full p-2 mt-1 text-sm text-gray-600 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option value="" disabled>
                                Select a Booking Status
                            </option>
                            <option
                                v-for="option in bookingStatus"
                                :value="option.id"
                            >
                                {{ option.name }}
                            </option>
                        </select>
                    </div>

                    <div class="flex justify-between pt-2">
                        <input
                            type="date"
                            v-model="checkInDate"
                            class="block w-full pl-10 pr-5 text-gray-900 border border-gray-300 rounded-md h-9 bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500"
                        />

                        <span class="items-center p-4">To</span>

                        <input
                            type="date"
                            v-model="checkOutDate"
                            class="block w-full pt-0 pb-0 pl-10 pr-5 text-gray-900 border border-gray-300 rounded-md h-9 bg-gray-50 text-sm focus:ring-blue-500 focus:border-blue-500"
                        />
                    </div>

                    <SecondaryButton @click="resetSearch()">
                        Reset
                    </SecondaryButton>

                    <PrimaryButton @click="handleSearch()">
                        Search
                    </PrimaryButton>
                </div>

                <div
                    class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="flex justify-between pb-4">
                        <div>
                            <h2
                                class="inline-flex items-center justify-center text-xl font-semibold leading-tight text-gray-800"
                            >
                                Booking - Index
                            </h2>
                        </div>
                        <div class="">
                            <PrimaryNavLink :href="route('booking.search')">
                                Search Bookings
                            </PrimaryNavLink>
                        </div>
                        <div class="">
                            <PrimaryNavLink :href="route('booking.create')">
                                Create a Booking
                            </PrimaryNavLink>
                        </div>
                    </div>

                    <table
                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-2 py-3 md:px6">
                                    Guest Name
                                </th>
                                <th scope="col" class="px-2 py-3 md:px6">
                                    Check-In Date
                                </th>
                                <th scope="col" class="px-2 py-3 md:px6">
                                    Check-Out Date
                                </th>
                                <th scope="col" class="px-2 py-3 md:px6">
                                    Guest Count
                                </th>
                                <th scope="col" class="px-2 py-3 md:px6">
                                    Booking Status
                                </th>
                                <th scope="col" class="px-2 py-3 md:px6">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="row in data.data"
                                :key="row.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                <td
                                    scope="row"
                                    class="px-2 py-3 font-medium text-gray-900 md:px6 dark:text-white"
                                >
                                    {{ row.guest_name }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-2 py-3 font-medium text-gray-900 md:px6 dark:text-white"
                                >
                                    {{ row.check_in_date }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-2 py-3 font-medium text-gray-900 md:px6 dark:text-white"
                                >
                                    {{ row.check_out_date }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-2 py-3 font-medium text-gray-900 md:px6 dark:text-white"
                                >
                                    {{ row.guest_count }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-2 py-3 font-medium text-gray-900 md:px6 dark:text-white"
                                >
                                    {{ row.booking_status.name }}
                                </td>
                                <td class="py-4">
                                    <SecondaryNavLink
                                        :href="route('booking.show', row)"
                                        class="mr-2"
                                    >
                                        View
                                    </SecondaryNavLink>
                                    <SecondaryNavLink
                                        :href="route('booking.edit', row)"
                                        class="mr-2"
                                    >
                                        Edit
                                    </SecondaryNavLink>
                                    <DangerButton @click="destroy(row.id)">
                                        Delete
                                    </DangerButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <Pagination class="mt-6" :links="data.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
