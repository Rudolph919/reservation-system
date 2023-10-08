<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-emerald-300 shadow">
                <div class="container flex items-center justify-between h-52">
                    <div class="flex items-center shrink-0">
                        <Link :href="route('home')">
                            <ApplicationLogo
                                class="block h-52 w-auto fill-current text-gray-800 pl-6"
                            />
                        </Link>
                    </div>

                    <div class="flex items-center">
                        <NavLink :href="route('home')" :active="route().current('home')" class="m-4 italic text-xl">
                            Home
                        </NavLink>
                        <NavLink :href="route('about')" :active="route().current('about')" class="m-4 italic text-xl">
                            About
                        </NavLink>
                        <NavLink :href="route('contact')" :active="route().current('contact')" class="m-4 italic text-xl">
                            Contact
                        </NavLink>
                    </div>

                    <div class="flex items-center pr-6">
                        <ul class="flex items-center">
                            <li>
                                <a href="/login" class="text-gray-600 hover:text-gray-800">Login</a>
                            </li>
                            <li class="ml-4">
                                <a href="/register" class="text-gray-600 hover:text-gray-800">Register</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot />
            </main>
        </div>
    </div>
</template>
