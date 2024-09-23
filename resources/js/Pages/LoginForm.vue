<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
    email: null,
    password: null,
    remember: false, 
});

const login = () => {
    form.post('/login', {
        onError: () => form.reset('password')
    });
}
</script>

<template>
    <Head title="Login" />
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-lg">
            <h2 class="text-2xl font-bold text-center">Login</h2>
            <form @submit.prevent="login" class="space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" v-model="form.email" type="email" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="you@example.com" />
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" v-model="form.password" type="password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                        placeholder="********" />
                </div>

                <div class="flex items-center">
                    <input id="remember" type="checkbox" v-model="form.remember"
                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                    <label for="remember" class="ml-2 block text-sm text-gray-900">Remember me</label>
                </div>

                <button type="submit"
                    class="w-full py-2 px-4 bg-indigo-600 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    Login
                </button>
                <p class="text-center text-sm text-gray-600">
                    Don't have an account?
                    <a :href="route('register')" class="text-indigo-600 hover:text-indigo-700">Register</a>
                </p>
            </form>
        </div>
    </div>
</template>
