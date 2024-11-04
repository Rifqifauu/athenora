<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-b from-purple-500 to-blue-500">
        <AuthenticationCard class="w-full max-w-md p-8 rounded-lg shadow-lg bg-white">
            <h2 class="text-2xl font-bold text-center text-gray-800 mb-6">Log In</h2>

            <div v-if="status" class="mb-4 text-sm text-green-600 text-center">
                {{ status }}
            </div>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <InputLabel for="email" value="Email" />
                    <TextInput
                        id="email"
                        v-model="form.email"
                        type="email"
                        class="mt-1 block w-full border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <InputError class="mt-2" :message="form.errors.email" />
                </div>

                <div class="mb-6">
                    <InputLabel for="password" value="Password" />
                    <TextInput
                        id="password"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full border-gray-300 rounded-md focus:border-blue-500 focus:ring focus:ring-blue-200"
                        required
                        autocomplete="current-password"
                    />
                    <InputError class="mt-2" :message="form.errors.password" />
                </div>

                <div class="flex items-center justify-between mb-4">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" v-model="form.remember" class="mr-2" />
                        Remember me
                    </label>
                    <Link href="#" class="text-sm text-blue-500 hover:underline">Forgot your password?</Link>
                </div>

                <PrimaryButton class="w-full h-12 bg-gradient-to-r from-blue-400 to-blue-600 text-white font-semibold rounded-md shadow-lg transition-transform duration-300 ease-in-out transform hover:scale-105" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>

                <div class="flex items-center justify-center mt-4">
                    <span class="text-sm text-gray-600">Belum Punya Akun? <Link href="/register" class="text-blue-500 hover:underline">Daftar!</Link></span>
                </div>

                <div class="mt-4 text-center">
                    <a href="auth/google" class="flex items-center justify-center w-full h-12 border border-gray-300 rounded-md bg-red-500 text-white hover:bg-red-600 transition-colors duration-200">
                        <img src="https://static-00.iconduck.com/assets.00/google-icon-2048x2048-pks9lbdv.png" alt="Google Logo" class="h-5 w-5 mr-2" />
                        <span>Login with Google</span>
                    </a>
                </div>
            </form>
        </AuthenticationCard>
    </div>
</template>

<style scoped>
/* Additional styles can be added here for further customization */
</style>
