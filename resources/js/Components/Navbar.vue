<!-- Navbar with Gradient Background -->
<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import axios from 'axios';

const isDropdownOpen = ref(false);

// Function to handle logout
const logout = async () => {
    try {
        await axios.post('/logout', { _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content') });
        window.location.href = '/'; // Redirect after logout
    } catch (error) {
        console.error('Logout failed:', error);
    }
};
</script>
<template>
    <div class="w-full mt-4 top-10 mx-4 md:mx-8 px-4 md:px-8 py-2 bg-gradient-to-r from-blue-800 to-purple-500 rounded-3xl flex justify-between items-center shadow-lg">
        <div class="flex items-center">
            <a href="/" class="text-white font-bold text-lg">Athenora</a>
        </div>
    
        <div class="flex items-center space-x-4 md:space-x-6">
            <a href="/#gallery" class="text-white font-semibold hover:underline">Galeri</a>
            <a href="/#pesantiket" class="text-white font-semibold hover:underline">Pesan Tiket</a>
            <a href="/#jadwalacara" class="text-white font-semibold hover:underline">Jadwal Acara</a>
    
            <template v-if="$page.props.auth.user">
                <div class="relative">
                    <button @click="isDropdownOpen = !isDropdownOpen" class="px-3 py-2 bg-white text-purple-500 font-semibold rounded-full transition-colors duration-300 hover:bg-black hover:text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                        Profil
                    </button>
                    <div v-if="isDropdownOpen" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                        <Link :href="route('detail-tiket.show')" class="block px-4 py-2 text-black hover:bg-gray-100">Dashboard Saya</Link>
                        <button @click="logout" class="block w-full text-left px-4 py-2 text-red-500 hover:bg-red-100">Logout</button> <!-- Change to red -->
                    </div>
                </div>
            </template>
            <template v-else>
                <Link :href="route('login')" class="px-3 py-2 bg-white text-purple-500 font-semibold rounded-full transition-colors duration-300 hover:bg-black hover:text-white focus:outline-none focus:ring-2 focus:ring-purple-500">
                    Log in
                </Link>
            </template>
        </div>
    </div>
    </template>
    

<style scoped>
/* Dropdown Menu Styles */
.absolute {
    display: none;
}
.relative:hover .absolute {
    display: block;
}
</style>
