<script setup>
import InputError from '@/Components/InputError.vue';
import NotificationError from '@/Components/NotificationError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import PrimaryNavLink from '@/Components/PrimaryNavLink.vue';
import TextInput from '@/Components/TextInput.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    resource: Object,
    resourceTypes: Object,
    title: String,
    error: String
});

const form = useForm({
    'resource': props.resource.name,
    'description': props.resource.description,
    'price': props.resource.price,
    'capacity': props.resource.capacity,
    'resourceTypeId': props.resource.resourceTypeId,
    'location': props.resource.location,
    'image': props.resource.image,
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
                                Resource - Edit
                            </h2>
                        </div>
                        <div>
                            <PrimaryNavLink
                                :href="route('resource.index')"
                            >
                                View Resource List
                            </PrimaryNavLink>
                        </div>
                    </div>
                    <form @submit.prevent="form.patch(route('resource.update', resource.id))">
                        <TextInput name="resource" v-model="form.resource" type="text" placeholder="Resource name" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.resource" />
                        <TextInput name="description" v-model="form.description" type="text" placeholder="Resource description" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.description" />

                        <!-- <SelectInput name="resourceTypeId" v-model="form.resourceTypeId" :optionList="resourceTypes" /> -->
                        <select name="resourceTypeId" v-model="form.resourceTypeId"
                            class="mt-1 border border-gray-300 text-gray-600 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full p-2">
                            <option  selected value="">Select a resource type</option>
                            <option v-for="option in resourceTypes" :value="option.id">
                                {{ option.name }}
                            </option>

                        </select>

                        <TextInput name="capacity" v-model="form.capacity" type="text" placeholder="Resource capacity" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.capacity" />

                        <TextInput name="price" v-model="form.price" type="text" placeholder="Resource price per day. eg. Format: 150.00" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.price" />

                        <TextInput name="location" v-model="form.location" type="text" placeholder="Resource location" class="mt-1 block w-full"/>
                        <InputError class="mt-2" :message="form.errors.location" />
                        <PrimaryButton class="mt-4">Update</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
