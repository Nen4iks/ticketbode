<script setup>
import { Head, usePage } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import { computed } from 'vue';

const page = usePage();
const user = computed(() => page.props.auth?.user || null);
</script>

<template>
    <Head title="Dashboard" />

    <Navbar :user="user" :canLogin="false" :canRegister="false" />

    <main class="container">
        <h1>Welcome to the Dashboard</h1>
        <p>This is a placeholder for dashboard content.</p>
    </main>
</template>

<style scoped>
.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 1rem;
    text-align: center;
}
</style>
