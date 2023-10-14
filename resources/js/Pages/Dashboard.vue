<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    bookingCount: {
        type: Number,
    },
    resourceCount: {
        type: Number,
    },
});

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

                <div class="flex">
                    <div class="bg-white shadow-sm sm:rounded-lg m-4">
                        <div class="p-6 text-gray-900">There is a total of <span class="text-xl font-bold">{{ bookingCount }}</span> bookings on the system.</div>
                    </div>
                    <div class="bg-white shadow-sm sm:rounded-lg m-4">
                        <div class="p-6 text-gray-900">There is a total of <span class="text-xl font-bold">{{ resourceCount }} </span> resources that can be booked.</div>
                    </div>
                </div>


            </div>
        </div>
    </AuthenticatedLayout>
</template>
