<script setup>
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import { ref } from 'vue';

// Define props
const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    tiket: Object,
    user: Object,
    flash: Object, // Include flash for success messages
    errors: Object, // Include errors for error messages
    havingTicket: Boolean,
});

console.log(props);
// Initialize form with tiket data
const form = useForm({
    tiket_id: props.tiket.tiket_id, // Include tiket_id from props
    user_id: props.user.id, // Include user_id from props
});

// Reactive variable for notifications
const notification = ref('');

// Check for errors and messages in the props
if (props.errors && props.errors.message) {
    notification.value = props.errors.message;
} else if (props.flash && props.flash.message) {
    notification.value = props.flash.message;
} else if (props.havingTicket) {
    notification.value = "Anda sudah memiliki tiket. Silahkan lihat di bagian profil atau melalui tombol di bawah!";
}

// Function to save order
const saveOrder = () => {
    form.post('/detail-tiket', {
        onSuccess: () => {
            console.log("Order saved successfully!");
        },
        onError: (errors) => {
            console.error("Error saving order:", errors);
        },
    });
};
</script>

<template>
    <Head title="Detail Tiket" />
    
    <div class="relative min-h-screen flex flex-col items-center bg-gray-50 px-4 sm:px-6 md:px-8">
        <Navbar />

        <div class="w-full max-w-3xl mt-8 space-y-6">
            <div class="p-6 bg-white rounded-lg shadow-lg border border-gray-300">
                <h1 class="text-2xl sm:text-3xl font-bold mb-4 text-center">Pesan Tiket</h1>

                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row justify-between">
                        <p class="font-semibold">Nama Pengguna:</p>
                        <p>{{ user.name }}</p>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-between">
                        <p class="font-semibold">Email Pengguna:</p>
                        <p>{{ user.email }}</p>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-between">
                        <p class="font-semibold">Kategori Tiket:</p>
                        <p class="text-green-600 font-bold">{{ tiket.kategori }}</p>
                    </div>
                    <div class="flex flex-col sm:flex-row justify-between">
                        <p class="font-semibold">Harga Tiket:</p>
                        <p class="text-red-600 font-bold">Rp {{ tiket.harga }}</p>
                    </div>
                </div>
            </div>

            <!-- Display notification messages -->
            <div v-if="notification" class="mt-4 p-4 text-white bg-blue-500 rounded text-center">
                {{ notification }}
                
                <!-- Buttons to view ticket and go back if the user already has a ticket -->
                <div v-if="havingTicket" class="mt-4 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 justify-center">
                    <a href="/detail-tiket/show" class="px-4 py-2 bg-yellow-500 text-white rounded-lg shadow hover:bg-yellow-600 transition">
                        Lihat Tiket
                    </a>
                    <a href="/" class="px-4 py-2 bg-red-500 text-white rounded-lg shadow hover:bg-red-400 transition">
                        Kembali
                    </a>
                </div>
            </div>

            <!-- Hide buttons if the user already has a ticket -->
            <div v-if="!havingTicket" class="flex flex-col sm:flex-row justify-end items-center mt-4 space-y-4 sm:space-y-0 sm:space-x-4">
                <button 
                    @click="saveOrder" 
                    class="px-4 py-2 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                    Simpan Pesanan
                </button>

                <a href="/" class="px-6 py-2 bg-red-600 text-white rounded-lg shadow hover:bg-red-700 transition">
                   Batal
                </a>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Custom styling if needed */
</style>
