<template>
    <div>
      <Head title="Admin Dashboard" /> <!-- Добавляем заголовок страницы -->
      
      <!-- Навигационная панель -->
      <Navbar />
  
      <div class="admin-dashboard">
        <h1>Admin Dashboard</h1>
        <p>Welcome to the admin panel.</p>
  
        <!-- Выводим информацию о текущем пользователе -->
        <div v-if="user">
          <p><strong>Name:</strong> {{ user.name }}</p>
          <p><strong>Email:</strong> {{ user.email }}</p>
        </div>
      </div>
    </div>
  </template>
  
  <script setup>
  import { computed } from 'vue';
  import { Head, usePage } from '@inertiajs/vue3';
  import Navbar from '@/Components/Navbar.vue';
  
  const page = usePage();
  const user = computed(() => page.props.user || null); // Данные о пользователе из маршрута
  </script>
  
  <style scoped>
  .admin-dashboard {
    padding: 20px;
  }
  
  .admin-dashboard h1 {
    font-size: 2rem;
    margin-bottom: 20px;
  }
  
  .admin-dashboard p {
    font-size: 1.2rem;
  }
  </style>
  