<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Modal from "@/components/Modal.vue";
import NotificationSuccess from "@/Components/NotificationSuccess.vue";
import Pagination from "@/Components/Pagination.vue";
import PrimaryNavLink from "@/Components/PrimaryNavLink.vue";
import SecondaryNavLink from "@/Components/SecondaryNavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";

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
    showModal: {
        type: Boolean,
        default: false
    },
    contactInfo: {
        type: Object,
    }
});

const openModal = (row) => {
    console.log(row);
}

const closeModal = () => {
    this.showModal = false;
}


const destroy = (id) => {
    router.delete(route('booking.destroy', id), {
        onBefore: () => confirm('Are you sure you want to delete this booking?'),
    })
}
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <div class="flex justify-center">
            <NotificationSuccess v-if="success" :message="success" />
        </div>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6"
                >
                    <div class="flex justify-between pb-4">
                        <div>
                            <h2
                                class="inline-flex items-center justify-center font-semibold text-xl text-gray-800 leading-tight"
                            >
                                Booking - Index
                            </h2>
                        </div>
                        <div class="">
                            <PrimaryNavLink
                                :href="route('booking.search')"
                            >
                                Search Bookings
                            </PrimaryNavLink>
                        </div>
                        <div class="">
                            <PrimaryNavLink
                                :href="route('booking.create')"
                            >
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
                                <th scope="col" class="px-2 py-3 md:px6">Actions</th>
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
                                    class="px-2 py-3 md:px6 font-medium text-gray-900 dark:text-white"
                                >
                                    {{ row.guest_name }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-2 py-3 md:px6 font-medium text-gray-900 dark:text-white"
                                >
                                    {{ row.check_in_date }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-2 py-3 md:px6 font-medium text-gray-900 dark:text-white"
                                >
                                    {{ row.check_out_date }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-2 py-3 md:px6 font-medium text-gray-900 dark:text-white"
                                >
                                    {{ row.guest_count }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-2 py-3 md:px6 font-medium text-gray-900 dark:text-white"
                                >
                                    {{ row.booking_status.name }}
                                </td>
                                <td class="py-4">
                                    <SecondaryNavLink
                                        :href="route('booking.show', row)"
                                        class="mr-2">
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
