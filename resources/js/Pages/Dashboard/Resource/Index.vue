<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import NotificationSuccess from "@/Components/NotificationSuccess.vue";
import Pagination from "@/Components/Pagination.vue";
import PrimaryNavLink from "@/Components/PrimaryNavLink.vue";
import SecondaryNavLink from "@/Components/SecondaryNavLink.vue";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head, router } from "@inertiajs/vue3";

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
    // if(confirm("Are you sure you want to delete this resource?")) {
    //     router.delete(route('resource.destroy', id), {method: 'delete'})
    // }

    router.delete(route('resource.destroy', id), {
        onBefore: () => confirm('Are you sure you want to delete this resource?'),
    })
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
                                Resource - Index
                            </h2>
                        </div>
                        <div class="">
                            <PrimaryNavLink
                                :href="route('resource.create')"
                            >
                                Create a Resource
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
                                    Resource
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Resource Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Price
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Capacity
                                </th>
                                <th scope="col" class="px-6 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="row in data.data"
                                :key="row.id"
                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                <td
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white"
                                >
                                    {{ row.name }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white"
                                >
                                    {{ row.resource_type.name }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    R {{ row.price }}
                                </td>
                                <td
                                    scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                                >
                                    {{ row.capacity }}
                                </td>
                                <td class="px-6 py-4">
                                    <SecondaryNavLink
                                        :href="route('resource.edit', row)"
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
                    <Pagination class="mt-6" :links="data.links" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
