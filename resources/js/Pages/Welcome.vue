<template>
    <Head>
        <title>Welcome to Ticketbode</title>
    </Head>
    <Navbar :user="user" :canLogin="canLogin" :canRegister="canRegister" />
    <HeroSection v-model:searchQuery="searchQuery" @search="searchEvents" />
    <FeaturedEvents :events="featuredEvents" :isAdmin="isAdmin" @edit="editEvent" />
    <CreateEventForm v-if="isAdmin" @eventCreated="handleEventCreated"/>
    <EditEventForm v-if="editingEvent" v-model:editingEvent="editingEvent" @save="updateEvent" @cancel="cancelEdit" />
    <AboutUs />

    <!-- Окно уведомления -->
    <div v-if="notification" class="notification">
        <p>{{ notification }}</p>
        <button @click="notification = null">Закрыть</button>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, usePage, router } from '@inertiajs/vue3'
import Navbar from '@/Components/Navbar.vue';
import HeroSection from '@/Welcome/HeroSection.vue';
import FeaturedEvents from '@/Welcome/FeaturedEvents.vue';
import EditEventForm from '@/Pages/Admin/EditEventForm.vue';
import CreateEventForm from '@/Pages/Admin/CreateEventForm.vue';
import AboutUs from '@/Welcome/AboutUs.vue';

const page = usePage();
const user = computed(() => page.props.auth.user || null);
const canLogin = computed(() => page.props.auth.canLogin ?? true);
const canRegister = computed(() => page.props.auth.canRegister ?? true);
const isAdmin = computed(() => page.props.auth.isAdmin);

const searchQuery = ref('');
const featuredEvents = ref([]);
const editingEvent = ref(null);
const notification = ref(null);

// Загружаем ивенты из Laravel
const fetchEvents = async () => {
    try {
        const response = await fetch('/events', {
            headers: { 'X-Inertia': 'true' }, // Важно!
        });
        const data = await response.json();
        featuredEvents.value = data;
    } catch (error) {
        console.error('Ошибка загрузки событий:', error);
    }
};

// Поиск событий (пока просто логирует)
const searchEvents = () => {
    console.log('Searching for:', searchQuery.value);
};

// Редактирование события
const editEvent = (event) => {
    editingEvent.value = { ...event };
};

// Отмена редактирования
const cancelEdit = () => {
    editingEvent.value = null;
};

// Обновление события
const updateEvent = async (eventData) => {
    try {
        await router.put(`/events/${eventData.id}`, eventData, {
            preserveScroll: true, // Оставить скролл на месте
            onSuccess: () => {
                fetchEvents(); // Загружаем обновленные события
                editingEvent.value = null; // Закрываем форму
            }
        });
    } catch (error) {
        console.error('Ошибка обновления:', error);
    }
};
// Обработка создания нового события
const handleEventCreated = async (event) => {
    try {
        await router.post('/events', event);
        notification.value = 'Событие добавлено успешно!';
        fetchEvents();
    } catch (error) {
        console.error('Ошибка добавления:', error);
        notification.value = 'Ошибка добавления события!';
    }
};

onMounted(() => {
    console.log('User:', user.value, 'Is Admin:', isAdmin.value);
    fetchEvents(); // Загружаем события при загрузке
});
</script>

<style scoped>
.notification {
    position: fixed;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    padding: 10px 20px;
    background-color: #4caf50;
    color: white;
    border-radius: 5px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}
</style>
