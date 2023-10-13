<script setup>
import PrimaryNavLink from "@/Components/PrimaryNavLink.vue";
import SecondaryNavLink from "@/Components/SecondaryNavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";
import NotificationSuccess from "@/Components/NotificationSuccess.vue";
import DangerButton from "@/Components/DangerButton.vue";

defineProps({
    title: {
        type: String,
    },
    data: {
        type: Object,
    },
    success: {
        type: String,
    },
});

const destroy = (id) => {
    if(confirm("Are you sure you want to delete this availability status?")) {
        router.visit(route('availability-status.destroy', id), {method: 'delete'})
    }
}

</script>

<template>
    <Head :title="title" />

    <AuthenticatedLayout>
        <div class="flex justify-center">
            <NotificationSuccess v-if="success" :message="success" />
        </div>

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
                                Availability Status - Index
                            </h2>
                        </div>
                        <div>
                            <PrimaryNavLink
                                :href="route('availability-status.create')"
                            >
                                Create an Availability Status
                            </PrimaryNavLink>
                        </div>
                    </div>

                    <table
                        class="w-full text-sm text-left text-gray-500 dark:text-gray-400"
                    >
                        <thead
                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400"
                        >
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Availability Status
                                </th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="row in data"
                                :key="row.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                <th
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    {{ row.name }}
                                </th>
                                <td class="px-6 py-4">
                                    <SecondaryNavLink
                                        :href="route('availability-status.edit', [row,])"
                                        class="mr-4"
                                    >
                                        Edit
                                    </SecondaryNavLink>
                                    <DangerButton @click="destroy(row.id)">
                                        Delete
                                    </DangerButton>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
