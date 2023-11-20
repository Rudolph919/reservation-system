<script setup>
import InputError from "@/Components/InputError.vue";
import NotificationError from "@/Components/NotificationError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import PrimaryNavLink from "@/Components/PrimaryNavLink.vue";
import TextInput from "@/Components/TextInput.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, useForm } from "@inertiajs/vue3";

defineProps({
    title: {
        type: String,
    },
    error: {
        type: String,
    },
});

const form = useForm({
    resourceType: "",
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
                                Resource Type - Create
                            </h2>
                        </div>
                        <div>
                            <PrimaryNavLink
                                :href="route('resource-type.index')"
                            >
                                View Resource Type List
                            </PrimaryNavLink>
                        </div>
                    </div>

                    <form
                        @submit.prevent="
                            form.post(route('resource-type.store'), {
                                onSuccess: () => form.reset(),
                            })
                        "
                    >
                        <TextInput
                            id="resourceType"
                            v-model="form.resourceType"
                            type="text"
                            class="block w-full mt-1"
                            autofocus
                        />
                        <InputError
                            class="mt-2"
                            :message="form.errors.resourceType"
                        />
                        <PrimaryButton class="mt-4">Create</PrimaryButton>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
