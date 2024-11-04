<template>
    <div v-if="show" class="fixed inset-0 flex items-center justify-center z-50">
      <div class="fixed inset-0 bg-black opacity-50" @click="closeModal"></div>
  
      <div class="bg-white p-5 rounded-lg shadow-lg w-full max-w-md z-10">
        <h3 class="text-lg font-semibold mb-4">Update User</h3>
        <form @submit.prevent="submitForm">
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
            <input 
              v-model="formData.name" 
              type="text" 
              id="name" 
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" 
              required 
            />
          </div>
  
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input 
              v-model="formData.email" 
              type="email" 
              id="email" 
              class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" 
              required 
            />
          </div>
  
          <div class="flex justify-end">
            <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-300 rounded mr-2">Cancel</button>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Save</button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios'; // Impor axios di bagian atas
  
  export default {
    props: {
      show: Boolean, // Kontrol visibilitas modal dari parent
      user: Object, // Data pengguna yang di-passing dari parent
    },
    data() {
      return {
        formData: {
          name: this.user.name, // Isi default dari user prop
          email: this.user.email,
        },
      };
    },
    watch: {
      user(newUser) {
        this.formData.name = newUser.name;
        this.formData.email = newUser.email;
      },
    },
    methods: {
      closeModal() {
        this.$emit('close'); // Emit event close untuk parent
      },
      async submitForm() {
        console.log('Submitting form with data:', this.formData);
        try {
          const response = await axios.put(`/admin/updateuser/${this.user.id}`, {
            name: this.formData.name,
            email: this.formData.email,
          });
  
          console.log('User updated successfully:', response.data);
  
          // Emit event ke parent setelah berhasil memperbarui
          this.$emit('user-updated', response.data.user); // Sesuaikan dengan struktur respons dari API
          this.closeModal(); // Tutup modal setelah submit
        } catch (error) {
          console.error('Error updating user:', error);
        }
      },
    },
  };
  </script>
  
  