<script setup>
import Booking from "@/Components/Booking.vue";
import PrimaryNavLink from "@/Components/PrimaryNavLink.vue";
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
    router.delete(route("booking.destroy", id), {
        onBefore: () =>
            confirm("Are you sure you want to delete this booking?"),
    });
};
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <div class="py-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg"
                >
                    <div class="flex justify-between pb-4">
                        <div>
                            <h2
                                class="inline-flex items-center justify-center text-xl font-semibold leading-tight text-gray-800"
                            >
                                Booking - Show
                            </h2>
                        </div>
                        <div class="">
                            <PrimaryNavLink :href="route('booking.index')">
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
