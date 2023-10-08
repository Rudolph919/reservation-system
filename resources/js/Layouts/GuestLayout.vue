<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="min-h-screen flex flex-col lg:flex-row justify-center items-center bg-emerald-500">
        <div>
            <Link href="/">
                <ApplicationLogo class="w-72 h-72 m-8" />
            </Link>
        </div>

        <div
            class="w-full sm:max-w-md mt-6 mb-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg"
        >
            <slot />
        </div>
    </div>
</template>
