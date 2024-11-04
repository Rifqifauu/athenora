<script setup>
import { onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';

// Define props
const props = defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    snapToken: String, // Include snapToken here
});

// Function to load the Snap.js script
function loadSnapScript() {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = 'https://app.sandbox.midtrans.com/snap/snap.js';
        script.setAttribute('data-client-key', 'Mid-client-FCGotWbwUjfjHKY6');
        script.onload = resolve;
        script.onerror = reject;
        document.body.appendChild(script);
    });
}

// Attach event listener after component is mounted
onMounted(async () => {
    try {
        await loadSnapScript(); // Load Snap.js script

        // Trigger snap popup with the transaction token as soon as the script is loaded
        if (window.snap && window.snap.pay) {
            window.snap.pay(props.snapToken, {
                onSuccess: function(result){
                    console.log(result); // Handle success scenario
                },
                onPending: function(result){
                    console.log(result); // Handle pending scenario
                },
                onError: function(result){
                    console.log(result); // Handle error scenario
                },
                onClose: function(){
                    alert('Payment popup closed');
                    window.location.href = '/detail-tiket/show';
                }
            });
        } else {
            console.error("Snap is not loaded properly or pay function is undefined");
        }
    } catch (error) {
        console.error("Failed to load Snap.js script:", error);
    }
});
</script>

<template>
    <Head title="Welcome" />

    <!-- Main Container -->
    <div class="relative min-h-screen flex flex-col items-center bg-white px-4 md:px-8">
        <Navbar />
    </div>
</template>
