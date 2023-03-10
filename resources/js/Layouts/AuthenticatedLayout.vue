<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="block lg:flex">
            <div class="hidden lg:block lg:w-[200px] overflow-auto h-screen fixed shadow-md">
                <!-- Navigation Links -->
                <div
                    class="flex items-center justify-center h-16 mb-8 bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <!-- Logo -->
                    <div class="shrink-0 flex items-center">
                        <Link :href="route('dashboard')">
                        <ApplicationLogo class="block h-9 w-auto text-gray-800 dark:text-gray-200" />
                        </Link>
                    </div>
                </div>
                <div class="hidden space-y-8 lg:-my-px lg:mx-3 lg:flex lg:flex-col lg:mb-6">
                    <NavLink class="text-lg" :href="route('dashboard')" :active="route().current('dashboard')">
                        Dashboard
                    </NavLink>
                    <NavLink class="text-lg" :href="route('books.index')" :active="route().current('books.index')">
                        Books
                    </NavLink>
                    <NavLink class="text-lg" :href="route('members.index')" :active="route().current('members.index')">
                        Members
                    </NavLink>
                    <NavLink class="text-lg" :href="route('categories.index')"
                        :active="route().current('categories.index')">
                        Categories
                    </NavLink>
                    <NavLink class="text-lg" :href="route('authors.index')" :active="route().current('authors.index')">
                        Authors
                    </NavLink>
                    <NavLink class="text-lg" :href="route('loans.index')" :active="route().current('loans.index')">
                        Loans
                    </NavLink>
                    <NavLink class="text-lg" :href="route('fines.index')" :active="route().current('fines.index')">
                        Fines
                    </NavLink>
                    <NavLink class="text-lg" :href="route('fine-payments.index')"
                        :active="route().current('fine-payments.index')">
                        Fine Payments
                    </NavLink>
                    <h3 class="text-xl font-bold px-1">Data</h3>
                    <NavLink class="text-lg" :href="route('daily-loan-count.index')"
                        :active="route().current('daily-loan-count.index')">
                        Daily Loan Count
                    </NavLink>
                    <NavLink class="text-lg" :href="route('most-loan-books.index')"
                        :active="route().current('most-loan-books.index')">
                        Most Loan Books
                    </NavLink>
                </div>
            </div>
            <div class="flex flex-col min-h-screen bg-gray-100 dark:bg-gray-900 lg:flex-grow lg:ml-[200px]">
                <nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
                    <!-- Primary Navigation Menu -->
                    <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="flex justify-end h-16">
                            <div class="hidden lg:flex lg:items-center lg:ml-6">
                                <!-- Settings Dropdown -->
                                <div class="ml-auto relative">
                                    <Dropdown align="right" width="48">
                                        <template #trigger>
                                            <span class="inline-flex rounded-md">
                                                <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                                    {{ $page.props.auth.user.name }}

                                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                        viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </span>
                                        </template>

                                        <template #content>
                                            <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                            <DropdownLink :href="route('logout')" method="post" as="button">
                                                Log Out
                                            </DropdownLink>
                                        </template>
                                    </Dropdown>
                                </div>
                            </div>

                            <!-- Hamburger -->
                            <div class="-mr-2 flex items-center lg:hidden">
                                <button @click="showingNavigationDropdown = !showingNavigationDropdown"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                        <path :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 12h16M4 18h16" />
                                        <path :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Responsive Navigation Menu -->
                    <div :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                        class="lg:hidden">
                        <div class="pt-2 pb-3 space-y-1">
                            <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                Dashboard
                            </ResponsiveNavLink>
                        </div>

                        <!-- Responsive Settings Options -->
                        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                            <div class="px-4">
                                <div class="font-medium text-base text-gray-800 dark:text-gray-200">
                                    {{ $page.props.auth.user.name }}
                                </div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                            </div>

                            <div class="mt-3 space-y-1">
                                <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                                <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                    Log Out
                                </ResponsiveNavLink>
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Page Heading -->
                <header v-if="$slots.header">
                    <div class="max-w-9xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <slot name="header" />
                    </div>
                </header>

                <!-- Page Content -->
                <main>
                    <div class="max-w-9xl mx-auto mb-9 sm:px-6 lg:px-8">
                        <slot />
                    </div>
                </main>

                <footer class="mt-auto">
                    <div class="text-center py-6">
                        <p>Copyright &copy; 2022, All Rights Reserved</p>
                    </div>
                </footer>

            </div>
        </div>
    </div>
</template>
