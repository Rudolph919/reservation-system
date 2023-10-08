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
        Contact Page Text
    </UnauthenticatedLayoutVue>
</template>
