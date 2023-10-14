<script setup>
import UnauthenticatedLayoutVue from '@/Layouts/UnauthenticatedLayout.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { useForm, Head } from '@inertiajs/vue3';

const form = useForm({
    message: '',
});

</script>

<template>
    <Head>
        <title>{{ $page.props.title }}</title>
    </Head>

    <UnauthenticatedLayoutVue>
        <!-- About Us Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-semibold mb-8">About Us</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <img src="https://via.placeholder.com/400" alt="Team" class="rounded-lg shadow-lg">
                </div>
                <div>
                    <h2 class="text-2xl font-semibold mb-4">Our Story</h2>
                    <p class="text-gray-700 mb-4">At BookingSite, we are passionate about providing you with the best booking experience. Our mission is to connect travelers with the perfect accommodations, from cozy bed and breakfasts to luxury hotels.</p>
                    <p class="text-gray-700">We believe that planning your next adventure should be a breeze. That's why we work tirelessly to bring you a wide range of options, so you can find the perfect place to stay and make lifelong memories.</p>
                </div>
            </div>
        </div>
    </section>
    </UnauthenticatedLayoutVue>
</template>
