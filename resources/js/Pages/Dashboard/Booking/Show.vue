<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import Booking from "@/components/Booking.vue";
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
    booking: {
        type: Object,
    },
});


const destroy = (id) => {
    router.delete(route('booking.destroy', id), {
        onBefore: () => confirm('Are you sure you want to delete this booking?'),
    })
}
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
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
                                Booking - Show
                            </h2>
                        </div>
                        <div class="">
                            <PrimaryNavLink
                                :href="route('booking.index')"
                            >
                                View Booking List
                            </PrimaryNavLink>
                        </div>
                    </div>

                    <div>
                        <Booking :booking="booking" />
                    </div>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
