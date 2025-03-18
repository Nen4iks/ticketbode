<template>
    <header class="header">
        <div class="header-container">
            <Link :href="route('welcome')" class="logo-container">
                <ApplicationLogo class="logo" />
            </Link>
            <nav class="nav">
                <nav v-if="canLogin" class="auth-nav">
                    <Link
                        v-if="user"
                        :href="route('dashboard')"
                        class="auth-button"
                    >
                        Dashboard
                    </Link>
                    <Link v-if="user" :href="route('profile.edit')" class="auth-button">
                        Profile
                    </Link>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="auth-button login"
                        >
                            Log in
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="auth-button register"
                        >
                            Register
                        </Link>
                    </template>
                </nav>
            </nav>
        </div>
    </header>
</template>

<script setup>
import { defineProps } from 'vue';
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const props = defineProps({
    user: Object,
    canLogin: Boolean,
    canRegister: Boolean,
});
</script>

<style scoped>
.header {
    background-color: #ffffff;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    padding: 1rem 0;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
}
.header-container {
    max-width: 1400px;
    margin: 0 auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 2rem;
}
.logo {
    height: 40px;
    width: auto;
    color: #2563eb;
}
.auth-nav {
    display: flex;
    gap: 1rem;
}
.auth-button {
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 500;
    transition: all 0.3s ease;
}
.login {
    background-color: transparent;
    color: #2563eb;
    border: 2px solid #2563eb;
}
.register {
    background-color: #2563eb;
    color: white;
    border: none;
}
</style>
