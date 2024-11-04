<script setup>
import { Head} from '@inertiajs/vue3';
import { onMounted } from 'vue';
import Swiper from 'swiper/bundle';
import 'swiper/swiper-bundle.css';
import Navbar from '@/Components/Navbar.vue';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
});

onMounted(() => {
    new Swiper('.swiper-container', {
        slidesPerView: 1,
        spaceBetween: 10,
        loop: true,
        autoplay: {
            delay: 3000, // Time in milliseconds before moving to the next slide
            disableOnInteraction: false, // Autoplay will not be disabled after user interactions
        },
    });
});
</script>

<template>
    <Head title="Welcome" />

    <!-- Main Container -->
    <div class="relative min-h-screen flex flex-col items-center bg-white px-4 md:px-8">
        <Navbar/>
        <!-- Page Content -->
        <div class="flex flex-col items-center justify-start flex-1 my-8 p-4">
            <!-- Image Gallery Wrapper with Padding -->
            <div id="gallery" class="w-full max-w-screen-lg px-4 mb-8"> <!-- Added margin bottom -->
                <div class="swiper-container w-full">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="https://png.pngtree.com/png-clipart/20210815/original/pngtree-music-festival-creative-gradient-banner-png-image_6639203.jpg" alt="Image 1" class="w-full h-auto rounded-lg shadow-md">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1459749411175-04bf5292ceea?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MTB8fGNvbmNlcnR8ZW58MHx8MHx8fDA%3D" alt="Image 2" class="w-full h-auto rounded-lg shadow-md">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1522158637959-30385a09e0da?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D" alt="Image 3" class="w-full h-auto rounded-lg shadow-md">
                        </div>
                        <div class="swiper-slide">
                            <img src="https://images.unsplash.com/photo-1470229722913-7c0e2dbbafd3?fm=jpg&q=60&w=3000&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8Y29uY2VydHxlbnwwfHwwfHx8MA%3D%3D" alt="Image 4" class="w-full h-auto rounded-lg shadow-md">
                        </div>
                    </div>

                    <!-- Add Pagination -->
                </div>
            </div>

           <!-- Ticket Cards Section -->
<!-- Ticket Cards Section -->
<div class=" px-4 py-6 grid grid-cols-1 md:grid-cols-3 gap-6 w-full max-w-screen-lg">
    <!-- Regular Ticket Card -->
    <div class="bg-gradient-to-r from-blue-800 to-purple-500 text-white p-6 rounded-lg shadow-lg flex flex-col justify-between">
        <div>
            <h2 class="text-xl font-semibold mb-4">Tiket Reguler</h2>
            <ul class="mb-4">
                <li>✔ Akses ke area umum</li>
                <li>✔ Merchandise eksklusif</li>
                <li>✔ Foto bersama artis</li>
            </ul>
        </div>
        <div class="mt-auto">
            <a href="/tiket/1" class="bg-white text-purple-500 font-semibold py-2 px-4 rounded-full block text-center transition-colors duration-300 hover:bg-black hover:text-white">
                Beli Tiket
            </a>
        </div>
    </div>

    <!-- Gold Ticket Card -->
    <div class="bg-gradient-to-r from-blue-800 to-purple-500 text-white p-6 rounded-lg shadow-lg flex flex-col justify-between">
        <div>
            <h2 class="text-xl font-semibold mb-4">Tiket Gold</h2>
            <ul class="mb-4">
                <li>✔ Akses ke area VIP</li>
                <li>✔ Merchandise eksklusif</li>
                <li>✔ Foto bersama artis</li>
                <li>✔ Makanan dan minuman gratis</li>
            </ul>
        </div>
        <div class="mt-auto">
            <a href="/tiket/2" class="bg-white text-purple-500 font-semibold py-2 px-4 rounded-full block text-center transition-colors duration-300 hover:bg-black hover:text-white">
                Beli Tiket
            </a>
        </div>
    </div>

    <!-- Diamond Ticket Card -->
    <div class="bg-gradient-to-r from-blue-800 to-purple-500 text-white p-6 rounded-lg shadow-lg flex flex-col justify-between">
        <div>
            <h2 class="text-xl font-semibold mb-4">Tiket Diamond</h2>
            <ul class="mb-4">
                <li>✔ Akses ke area VIP</li>
                <li>✔ Merchandise eksklusif</li>
                <li>✔ Foto bersama artis</li>
                <li>✔ Makanan dan minuman gratis</li>
                <li>✔ Akomodasi hotel bintang lima</li>
            </ul>
        </div>
        <div class="mt-auto">
            <a href="/tiket/3" class="bg-white text-purple-500 font-semibold py-2 px-4 rounded-full block text-center transition-colors duration-300 hover:bg-black hover:text-white">
                Beli Tiket
            </a>
        </div>
    </div>
</div>
        </div>
    </div>
</template>

<style scoped>
.swiper-container {
    width: 100%;
    height: 400px; /* Adjust height as needed */
    overflow: hidden; /* Ensure no overflow occurs */
}

.swiper-slide {
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Ensure the gallery does not overflow */
@media (max-width: 768px) {
    .swiper-container {
        max-width: 100%; /* Make the gallery full width on smaller screens */
    }
}
</style>
