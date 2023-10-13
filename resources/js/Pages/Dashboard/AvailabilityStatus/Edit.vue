<script setup>
import PrimaryNavLink from '@/Components/PrimaryNavLink.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { computed } from 'vue'
import { Head, Link, useForm } from '@inertiajs/vue3';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { ref } from 'vue';
import NotificationError from '@/Components/NotificationError.vue';

const props = defineProps({
    availabilityStatus: Object,
    title: String,
    error: String
});

const form = useForm({
    'availabilityStatus': props.availabilityStatus.name,
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
                                Availability Status - Edit
                            </h2>
                        </div>
                        <div>
                            <PrimaryNavLink
                                :href="route('availability-status.index')"
                            >
                                View Availability Status List
                            </PrimaryNavLink>
                        </div>
                    </div>

                    <form @submit.prevent="form.patch(route('availability-status.update', availabilityStatus.id))">
                        <TextInput name="availabilityStatus" v-model="form.availabilityStatus" type="text" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.availabilityStatus" />
                        <PrimaryButton class="mt-4">Update</PrimaryButton>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
