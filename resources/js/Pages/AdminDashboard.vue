<template>
  <div class="min-h-screen bg-gray-100 flex">
    <Sidebar />
    <main class="flex-1 p-6">
      <header>
        <h1 class="text-2xl font-bold">Selamat Datang di Athenora</h1>
      </header>

      <!-- Menggunakan conditional rendering untuk menampilkan komponen yang sesuai -->
      <component :is="currentComponent" :users="users" v-if="currentComponent" />
    </main>
  </div>
</template>

<script>
import { defineComponent, ref, watch } from 'vue';
import Sidebar from '@/Components/Sidebar.vue';
import UsersTable from '@/Components/UsersTable.vue';

export default defineComponent({
  components: {
    Sidebar,
    UsersTable,
  },
  props: {
    users: Array, // Menerima data pengguna sebagai props dari Laravel
  },
  setup(props) {
    const currentComponent = ref(''); // Menyimpan nama komponen yang akan dirender

    // Fungsi untuk mengganti komponen berdasarkan rute
    function setComponent() {
      const path = window.location.pathname; // Mendapatkan path dari URL
      if (path.includes('/users')) {
        currentComponent.value = 'UsersTable'; // Komponen tabel user
      } else {
        currentComponent.value = ''; // Default
      }
    }

    // Mengatur komponen saat halaman dimuat
    watch(() => window.location.pathname, setComponent, { immediate: true });

    return {
      currentComponent,
      users: props.users, // Menggunakan props yang diterima
    };
  },
});
</script>
