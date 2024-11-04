<template>
  <div class="max-w-[1080px] mx-auto">
    <!-- Users List Section -->
    <div class="w-full flex justify-between items-center mb-3 mt-1 pl-3">
      <h3 class="text-lg font-semibold text-slate-800">Users List</h3>
      <div>
        <input
          v-model="searchQuery"
          class="bg-white w-full pr-11 h-10 pl-3 py-2 bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded transition duration-200 ease focus:outline-none focus:border-slate-400 hover:border-slate-400 shadow-sm focus:shadow-md"
          placeholder="Search for user..."
        />
      </div>
    </div>

    <!-- Users Table Section -->
    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
      <table class="w-full text-left table-auto min-w-max">
        <thead>
          <tr>
            <th class="p-4 border-b border-slate-200 bg-slate-50">ID</th>
            <th class="p-4 border-b border-slate-200 bg-slate-50">Name</th>
            <th class="p-4 border-b border-slate-200 bg-slate-50">Email</th>
            <th class="p-4 border-b border-slate-200 bg-slate-50 text-center">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="user in filteredUsers" :key="user.id" class="hover:bg-slate-50 border-b border-slate-200">
            <td class="p-4 py-5">{{ user.id }}</td>
            <td class="p-4 py-5">{{ user.name }}</td>
            <td class="p-4 py-5">{{ user.email }}</td>
            <td class="p-4 py-5 text-center">
              <button class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600" @click="openUpdateModal(user)">Edit</button>
              <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 ml-2" @click="deleteUser(user.id)">Delete</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

    <!-- Update Modal Section -->
    <UpdateUser v-if="showModal" :show="showModal" :user="selectedUser" @close="closeModal" />
  </div>
</template>

<script>
import UpdateUser from './UpdateUser.vue';
import axios from 'axios';

export default {
  components: {
    UpdateUser,
  },
  props: {
    users: Array,
  },
  data() {
    return {
      searchQuery: '',
      showModal: false,
      selectedUser: null,
    };
  },
  computed: {
    filteredUsers() {
      return this.users.filter(user => {
        return (
          user.name.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
          user.email.toLowerCase().includes(this.searchQuery.toLowerCase())
        );
      });
    },
  },
  methods: {
    openUpdateModal(user) {
      this.selectedUser = user;
      this.showModal = true;
    },
    closeModal() {
      this.showModal = false;
    },
    async deleteUser(userId) {
      if (confirm('Are you sure you want to delete this user?')) {
        try {
          await axios.post(`/admin/delusers/${userId}`);
          this.$emit('user-deleted', userId); // Emit an event to update the user list
        } catch (error) {
          console.error('Error deleting user:', error);
        }
      }
    },
  },
};
</script>

<style scoped>
/* Add any additional styles here */
</style>
