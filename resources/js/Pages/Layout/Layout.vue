<script setup>
import { Link, Head } from '@inertiajs/vue3';
import { ref } from 'vue';

const currentRoute = ref(route().current());
</script>

<template>
    <Head title="Dashboard Layout" />

    <div class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md flex flex-col">
            <div class="p-6 text-2xl font-bold text-center text-indigo-600 tracking-wide border-b">
                DASHLOG.
            </div>
            <nav class="flex-1 px-4 py-6 space-y-4">
                <ul class="space-y-2">
                    <li>
                        <Link :href="route('dashboard')"
                            :class="{
                                'bg-indigo-600 text-white': currentRoute === 'dashboard',
                                'text-gray-800': currentRoute !== 'dashboard',
                            }"
                            class="block border-b py-3 px-4 rounded-lg hover:bg-indigo-600 hover:text-white transition-colors font-semibold">
                        Dashboard
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('employees')"
                            :class="{
                                'bg-indigo-600 text-white': currentRoute === 'employees',
                                'text-gray-800': currentRoute !== 'employees',
                            }"
                            class="block border-b py-3 px-4 rounded-lg hover:bg-indigo-600 hover:text-white transition-colors font-semibold">
                        Employees
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('service-records')"
                            :class="{
                                'bg-indigo-600 text-white': currentRoute === 'service-records',
                                'text-gray-800': currentRoute !== 'service-records',
                            }"
                            class="block border-b py-3 px-4 rounded-lg hover:bg-indigo-600 hover:text-white transition-colors font-semibold">
                        Service Records
                        </Link>
                    </li>
                    <li>
                        <Link :href="route('departments')"
                            :class="{
                                'bg-indigo-600 text-white': currentRoute === 'departments',
                                'text-gray-800': currentRoute !== 'departments',
                            }"
                            class="block border-b py-3 px-4 rounded-lg hover:bg-indigo-600 hover:text-white transition-colors font-semibold">
                        Departments
                        </Link>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 flex flex-col">
            <!-- Navbar -->
            <header class="bg-white shadow-md px-6 py-5 border-b">
                <div class="flex items-center justify-between">
                    <div class="text-xl font-semibold text-gray-700">
                        Welcome here darling, {{ $page.props.auth.user.name }}!
                    </div>
                    <Link :href="route('logout')" method="post" as="button"
                        class="px-4 py-2 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition-colors">
                    Logout
                    </Link>
                </div>
            </header>

            <main class="flex-1 p-6 bg-gray-50">
                <slot />
            </main>
        </div>
    </div>
</template>
