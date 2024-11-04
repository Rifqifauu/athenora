<template>
    <aside class="bg-blue-600 text-white w-64 p-6 shadow-lg">
      <h2 class="text-2xl font-bold mb-6">Athenora</h2>
      <nav>
        <ul>
          <li class="mb-4">
            <Link
              href="/admin/users"
              class="flex items-center p-2 text-blue-200 hover:bg-blue-700 rounded transition duration-300"
              @click="handleClick('Users')">
              Users
            </Link>
          </li>
          <li class="mb-4">
            <Link
              href="/admin/posts"
              class="flex items-center p-2 text-blue-200 hover:bg-blue-700 rounded transition duration-300"
              @click="handleClick('Posts')">
              Posts
            </Link>
          </li>
          <li class="mb-4">
            <Link
              href="/admin/reports"
              class="flex items-center p-2 text-blue-200 hover:bg-blue-700 rounded transition duration-300"
              @click="handleClick('Reports')">
              Reports
            </Link>
          </li>
        </ul>
      </nav>
    </aside>
  </template>
  
  <script setup>
  import { Link } from '@inertiajs/inertia-vue3';
  
  const handleClick = (linkName) => {
    console.log(`${linkName} link clicked`);
  };
  </script>
  
  <style scoped>
  /* Tambahkan style tambahan jika diperlukan */
  </style>
  