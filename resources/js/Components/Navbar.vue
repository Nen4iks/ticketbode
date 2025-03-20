<script setup>
import { defineProps, ref } from 'vue';
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';

const props = defineProps({
    user: Object, // Информация о пользователе (null, если не авторизован)
    canLogin: Boolean,
    canRegister: Boolean,
});

const showingNavigationDropdown = ref(false);
</script>

<template>
    <header class="bg-white border-b border-gray-200 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <Link :href="route('welcome')">
                    <ApplicationLogo class="h-9 w-auto fill-current text-indigo-600" />
                </Link>
            </div>

            <!-- Навигация для зарегистрированных пользователей -->
            <nav v-if="user" class="hidden sm:flex space-x-8">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="text-gray-800 hover:text-indigo-600 transition">Dashboard</NavLink>

                <!-- Кнопка для админов -->
                <NavLink v-if="user.is_admin" :href="route('admin.dashboard')" :active="route().current('admin.dashboard')" class="text-gray-800 hover:text-indigo-600 transition">
                    Admin Panel
                </NavLink>
            </nav>

            <!-- Навигация для гостей -->
            <nav v-else-if="canLogin" class="hidden sm:flex space-x-4">
                <Link :href="route('login')" class="px-4 py-2 text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition">
                    Log in
                </Link>
                <Link v-if="canRegister" :href="route('register')" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Register
                </Link>
            </nav>

            <!-- Дропдаун для авторизованных пользователей -->
            <div v-if="user" class="relative ms-3 hidden sm:flex">
                <Dropdown align="right" width="48">
                    <template #trigger>
                        <button class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-800 bg-white hover:bg-indigo-100 hover:text-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-600 transition">
                            {{ user.name }}
                            <svg class="ms-2 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </template>

                    <template #content>
                        <div class="py-1 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none transition-all">
                            <!-- Profile Link with same styles as Log Out -->
                            <DropdownLink :href="route('profile.edit')" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-600 transition">Profile</DropdownLink>
                            <!-- Log Out with consistent styling -->
                            <DropdownLink :href="route('logout')" method="post" as="button" class="block px-4 py-2 text-gray-700 hover:bg-indigo-100 hover:text-indigo-600 transition">Log Out</DropdownLink>
                        </div>
                    </template>
                </Dropdown>
            </div>

            <!-- Гамбургер для мобильных устройств -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="showingNavigationDropdown = !showingNavigationDropdown" class="p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ hidden: showingNavigationDropdown, 'inline-flex': !showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ hidden: !showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Мобильное меню -->
        <div v-if="showingNavigationDropdown" class="sm:hidden bg-white shadow-lg rounded-b-lg">
            <div v-if="user" class="pt-2 pb-3 space-y-1">
                <NavLink :href="route('dashboard')" :active="route().current('dashboard')" class="block px-4 py-2 text-gray-800 hover:bg-indigo-100 transition">Dashboard</NavLink>
                <NavLink :href="route('profile.edit')" :active="route().current('profile.edit')" class="block px-4 py-2 text-gray-800 hover:bg-indigo-100 transition">Profile</NavLink>
                <!-- Кнопка для админов в мобильной версии -->
                <NavLink v-if="user.is_admin" :href="route('admin.dashboard')" :active="route().current('admin.dashboard')" class="block px-4 py-2 text-gray-800 hover:bg-indigo-100 transition">Admin Panel</NavLink>
                <NavLink :href="route('logout')" method="post" as="button" class="block px-4 py-2 text-gray-800 hover:bg-indigo-100 transition">Log Out</NavLink>
            </div>

            <div v-else class="pt-2 pb-3 space-y-1">
                <Link :href="route('login')" class="block px-4 py-2 text-center text-indigo-600 border border-indigo-600 rounded-lg hover:bg-indigo-600 hover:text-white transition">
                    Log in
                </Link>
                <Link v-if="canRegister" :href="route('register')" class="block px-4 py-2 text-center bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Register
                </Link>
            </div>
        </div>
    </header>
</template>

<style scoped>
/* Стили для навигации и кнопок */
header {
    background-color: white;
    border-bottom: 1px solid #E5E7EB;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

nav a {
    text-decoration: none;
    color: #4B5563;
    transition: color 0.3s ease;
}

nav a:hover {
    color: #2563EB;
}

button {
    transition: all 0.3s ease;
}

button:hover {
    background-color: #F3F4F6;
}

.sm\\:hidden {
    display: none;
}

@media (max-width: 768px) {
    /* Мобильное меню */
    .sm\\:hidden {
        display: block;
    }
}

/* Стили для кнопки дропдауна */
button {
    display: flex;
    align-items: center;
    justify-content: space-between;
    font-size: 1rem;
    font-weight: 600;
    padding: 0.5rem 1rem;
    border: 1px solid #E5E7EB;
    background-color: white;
    color: #374151;
    border-radius: 0.375rem; /* rounded-lg */
    transition: background-color 0.3s, color 0.3s, box-shadow 0.3s;
}

/* Наведение и фокус на кнопке */
button:hover {
    background-color: #E0E7FF; /* светлый синий фон */
    color: #4F46E5; /* синий цвет текста */
}

button:focus {
    box-shadow: 0 0 0 2px rgba(67, 56, 202, 0.5); /* синий фокус */
}

/* Стили для выпадающего меню */
div[role="menu"] {
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
    background-color: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border-radius: 0.375rem;
    max-width: 12rem;
    width: auto;
    transition: transform 0.3s ease-in-out;
}

div[role="menu"] a {
    display: block;
    padding: 0.5rem 1rem;
    color: #4B5563;
    font-size: 1rem;
    font-weight: 500;
    transition: background-color 0.3s, color 0.3s;
}

/* Наведение на элементы меню */
div[role="menu"] a:hover {
    background-color: #E0E7FF;
    color: #4F46E5;
}
</style>
