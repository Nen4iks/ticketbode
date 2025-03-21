<template>
  <div>
    <Head title="Admin Dashboard" />
    
    <Navbar />
  
    <div class="admin-dashboard" v-if="isAdmin">
      <h1>Admin Dashboard</h1>
      <p>Welcome to the admin panel.</p>
      <div v-if="user">
        <p><strong>Name:</strong> {{ user.name }}</p>
        <p><strong>Email:</strong> {{ user.email }}</p>
      </div>
    </div>
    <div v-else>
      <p>You do not have admin access.</p>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';

const page = usePage();
const user = computed(() => page.props.auth.user || null);
const isAdmin = computed(() => page.props.auth.isAdmin);
</script>
