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
        <!-- Contact Us Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl font-semibold mb-8">Contact Us</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div>
                    <h2 class="text-2xl font-semibold mb-4">Get in Touch</h2>
                    <p class="text-gray-700 mb-4">Have a question or need assistance with your booking? We're here to help. Feel free to contact our support team for any inquiries or issues.</p>
                    <p class="text-gray-700">Our dedicated staff is ready to assist you. You can reach us through the contact details provided below.</p>
                    <ul class="mt-4">
                        <li>Email: <a href="mailto:contact@bookingsite.com">contact@bookingsite.com</a></li>
                        <li>Phone: +1 (123) 456-7890</li>
                        <li>Address: 123 Booking St, Booking City</li>
                    </ul>
                </div>
                <div>
                    <h2 class="text-2xl font-semibold mb-4">Contact Form</h2>
                    <form>
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Your Name</label>
                            <input type="text" id="name" name="name" class="w-full rounded-lg p-2 border">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Your Email</label>
                            <input type="email" id="email" name="email" class="w-full rounded-lg p-2 border">
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700">Your Message</label>
                            <textarea id="message" name="message" rows="4" class="w-full rounded-lg p-2 border"></textarea>
                        </div>
                        <button type="submit" class="bg-blue-500 text-white rounded-lg py-2 px-4 hover:bg-blue-600">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    </UnauthenticatedLayoutVue>
</template>
