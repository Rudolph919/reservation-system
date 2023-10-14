<script setup>
import InputError from '@/Components/InputError.vue';
import NotificationError from '@/Components/NotificationError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import PrimaryNavLink from '@/Components/PrimaryNavLink.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    addOn: Object,
    title: String,
    error: String
});

const form = useForm({
    'addOn': props.addOn.name,
    'description': props.addOn.description,
    'price': props.addOn.price,
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
                                Add-On - Edit
                            </h2>
                        </div>
                        <div>
                            <PrimaryNavLink
                                :href="route('booking-status.index')"
                            >
                                View Add-On List
                            </PrimaryNavLink>
                        </div>
                    </div>
                    <form @submit.prevent="form.patch(route('add-on.update', addOn.id))">
                        <TextInput name="addOn" v-model="form.addOn" type="text" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.addOn" />
                        <TextInput name="description" v-model="form.description" type="text" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.description" />
                        <TextInput name="price" v-model="form.price" type="text" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.price" />
                        <PrimaryButton class="mt-4">Update</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
