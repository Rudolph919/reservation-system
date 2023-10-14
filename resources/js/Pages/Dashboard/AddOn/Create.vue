<script setup>
import InputError from '@/Components/InputError.vue';
import NotificationError from '@/Components/NotificationError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import PrimaryNavLink from '@/Components/PrimaryNavLink.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    title: {
        type: String,
    },
    error: {
        type: String,
    },
});

const form = useForm({
    addOn: '',
    description: '',
    price: '',
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
                                Add-On - Create
                            </h2>
                        </div>
                        <div>
                            <PrimaryNavLink
                                :href="route('add-on.index')"
                            >
                                View Add-On List
                            </PrimaryNavLink>
                        </div>
                    </div>
                    <form @submit.prevent="form.post(route('add-on.store'), { onSuccess: () => form.reset() })">
                        <TextInput name="addOn" v-model="form.addOn" type="text" placeholder="Add-on name" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.addOn" />
                        <TextInput name="description" v-model="form.description" type="text" placeholder="Add-on description" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.description" />
                        <TextInput name="price" v-model="form.price" type="text" placeholder="Add-on price. eg. Format: 150.00" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.price" />
                        <PrimaryButton class="mt-4">Create</PrimaryButton>
                    </form>

                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
