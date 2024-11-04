<script setup>
import { Head, usePage } from '@inertiajs/vue3'; 
import Navbar from '@/Components/Navbar.vue';
import axios from 'axios';
import { ref } from 'vue';

const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    tiket: Object,
});

// Access $page using usePage to retrieve flash messages
const { props: pageProps } = usePage();

// Function to format the date
const formatDate = (dateString) => {
    if (!dateString) return '';
    const date = new Date(dateString);
    return date.toLocaleDateString();
};

// Function to handle ticket payment
async function handlePayment() {
    try {
        // Prepare the payment data
        const paymentData = {
            kode_tiket: props.tiket.kode, // Ticket code from props
            gross_amount: 50000, // Example amount, replace with actual if dynamic
            name: pageProps.auth.user.name, // Access user name from pageProps
            email: pageProps.auth.user.email, // Access user email from pageProps
        };

        // Send request to backend to create payment
        const response = await axios.post('/payment', paymentData);
        
        // Check if response was successful and handle accordingly
        if (response.status === 200) {
            window.location.href = '/payment'; // Redirect to payment page
        }
    } catch (error) {
        console.error('Failed to initiate payment:', error);
    }
}
</script>

<template>
    <Head title="Dashboard Pengguna" />
    <div class="relative min-h-screen flex flex-col items-center bg-gray-100 px-4 md:px-8 py-8">
        <Navbar />
        <div class="container mx-auto mt-8 bg-white p-6 rounded-lg shadow-lg">
            <h1 class="text-2xl font-bold text-center mb-6">Dashboard Pengguna</h1>
            
            <!-- Flash Message Section -->
            <div v-if="pageProps.flash?.message" class="mb-4 p-4 bg-green-50 border border-green-200 text-green-600 rounded-lg">
                {{ pageProps.flash.message }}
            </div>
            <div v-if="pageProps.flash?.error" class="mb-4 p-4 bg-red-50 border border-red-200 text-red-600 rounded-lg">
                {{ pageProps.flash.error }}
            </div>
            
            <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <h2 class="text-lg font-bold text-blue-600">Informasi Pengguna</h2>
                <p class="text-gray-700">Nama: <span class="font-semibold">{{ pageProps.auth.user.name }}</span></p>
                <p class="text-gray-700">Email: <span class="font-semibold">{{ pageProps.auth.user.email }}</span></p>
            </div>

            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <h2 class="text-lg font-bold text-green-600">Detail Tiket</h2>
                <template v-if="tiket && Object.keys(tiket).length > 0">
                    <p class="text-gray-700">Kode Tiket: <span class="font-semibold">{{ tiket.kode }}</span></p>
                    <p class="text-gray-700">Status: <span class="font-semibold">{{ tiket.status }}</span></p>
                    <p class="text-gray-700">Tanggal: <span class="font-semibold">{{ formatDate(tiket.created_at) }}</span></p>
                </template>
                <template v-else>
                    <p class="text-gray-700">Anda belum melakukan pemesanan tiket.</p>
                </template>
            </div>

            <div class="text-center">
                <button
                    class="bg-blue-500 text-white font-semibold py-2 px-6 rounded-lg hover:bg-blue-600 transition duration-200 shadow-md"
                    @click="handlePayment"
                    v-if="tiket && Object.keys(tiket).length > 0"
                >
                    Bayar Tiket
                </button>
            </div>
        </div>
    </div>
</template>
