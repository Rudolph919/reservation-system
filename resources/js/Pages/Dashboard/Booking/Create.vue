<script setup>
import InputError from '@/Components/InputError.vue';
import NotificationError from '@/Components/NotificationError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import PrimaryNavLink from '@/Components/PrimaryNavLink.vue';
import TextInput from '@/Components/TextInput.vue';
import SelectInput from '@/Components/SelectInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ref } from "vue";

defineProps({
    title: {
        type: String,
    },
    error: {
        type: String,
    },
    resource: {
        type: Object,
    },
});

const form = useForm({
    checkInDate: '',
    checkOutDate: '',
    resourceId: '',
    guestName: '',
    guestEmail: '',
    guestPhone: '',
    guestCount: '',
});
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <div class="flex justify-center">
            <NotificationError v-if="error" :message="error" />
        </div>

        <div class="py-8">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="flex justify-between pb-4">
                        <div>
                            <h2
                                class="inline-flex items-center justify-center font-semibold text-xl text-gray-800 leading-tight"
                            >
                                Booking - Create
                            </h2>
                        </div>
                        <div>
                            <PrimaryNavLink
                                :href="route('booking.index')"
                            >
                                View Booking List
                            </PrimaryNavLink>
                        </div>
                    </div>
                    <form @submit.prevent="form.post(route('booking.store'), { onSuccess: () => form.reset() })">

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

                        <select name="resourceId" v-model="form.resourceId"
                            class="mt-1 border border-gray-300 text-gray-600 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                            <option  selected value="">Select a resource</option>
                            <option v-for="option in resource" :value="option.id">
                                {{ option.name }}
                            </option>
                        </select>

                        <TextInput name="guestName" v-model="form.guestName" type="text" placeholder="Guest name" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.guestName" />
                        <TextInput name="guestEmail" v-model="form.guestEmail" type="text" placeholder="Guest email" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.guestEmail" />
                        <TextInput name="guestPhone" v-model="form.guestPhone" type="text" placeholder="Guest phone" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.guestPhone" />
                        <TextInput name="guestCount" v-model="form.guestCount" type="text" placeholder="Guest count" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.guestCount" />



                        <PrimaryButton class="mt-4">Create</PrimaryButton>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

