<script setup>
import InputError from "@/Components/InputError.vue";
import NotificationError from "@/Components/NotificationError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PrimaryNavLink from "@/Components/PrimaryNavLink.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

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
    checkInDate: "",
    checkOutDate: "",
    resourceId: "",
    guestName: "",
    guestEmail: "",
    guestPhone: "",
    guestCount: "",
});
</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <div class="flex justify-center">
            <NotificationError v-if="error" :message="error" />
        </div>

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
                                Booking - Create
                            </h2>
                        </div>
                        <div>
                            <PrimaryNavLink :href="route('booking.index')">
                                View Booking List
                            </PrimaryNavLink>
                        </div>
                    </div>
                    <form
                        @submit.prevent="
                            form.post(route('booking.store'), {
                                onSuccess: () => form.reset(),
                            })
                        "
                    >
                        <div class="flex justify-between">
                            <input
                                type="date"
                                v-model="form.checkInDate"
                                class="block w-full pl-10 pr-5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                                autofocus
                            />

                            <span class="p-4">To</span>

                            <input
                                type="date"
                                v-model="form.checkOutDate"
                                class="block w-full pl-10 pr-5 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-md focus:ring-blue-500 focus:border-blue-500"
                            />
                        </div>

                        <select
                            name="resourceId"
                            v-model="form.resourceId"
                            class="block w-full p-2 mt-1 text-sm text-gray-600 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                        >
                            <option selected value="">Select a resource</option>
                            <option
                                v-for="option in resource"
                                :value="option.id"
                            >
                                {{ option.name }}
                            </option>
                        </select>

                        <TextInput
                            name="guestName"
                            v-model="form.guestName"
                            type="text"
                            placeholder="Guest name"
                            class="block w-full mt-1"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.guestName"
                        />
                        <TextInput
                            name="guestEmail"
                            v-model="form.guestEmail"
                            type="text"
                            placeholder="Guest email"
                            class="block w-full mt-1"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.guestEmail"
                        />
                        <TextInput
                            name="guestPhone"
                            v-model="form.guestPhone"
                            type="text"
                            placeholder="Guest phone"
                            class="block w-full mt-1"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.guestPhone"
                        />
                        <TextInput
                            name="guestCount"
                            v-model="form.guestCount"
                            type="text"
                            placeholder="Guest count"
                            class="block w-full mt-1"
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.guestCount"
                        />

                        <PrimaryButton class="mt-4">Create</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
