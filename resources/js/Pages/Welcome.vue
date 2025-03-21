<template>
    <Head>
        <title>Welcome to Ticketbode</title>
    </Head>
    <Navbar :user="user" :canLogin="canLogin" :canRegister="canRegister" />
    <HeroSection v-model:searchQuery="searchQuery" @search="searchEvents" />
    <FeaturedEvents :events="featuredEvents" :isAdmin="isAdmin" @edit="editEvent" />
    <EditEventForm v-if="editingEvent" v-model:editingEvent="editingEvent" @save="updateEvent" @cancel="cancelEdit" />
    <AboutUs />
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import HeroSection from '@/Welcome/HeroSection.vue';
import FeaturedEvents from '@/Welcome/FeaturedEvents.vue';
import EditEventForm from '@/Pages/Admin/EditEventForm.vue';
import AboutUs from '@/Welcome/AboutUs.vue';

const page = usePage();
const user = computed(() => page.props.auth.user || null);
const canLogin = computed(() => page.props.auth.canLogin ?? true);
const canRegister = computed(() => page.props.auth.canRegister ?? true);
const isAdmin = computed(() => page.props.auth.isAdmin);

const searchQuery = ref('');
const featuredEvents = ref([
    { id: 1, name: 'Summer Music Festival', date: '2024-07-15', price: '€59.99', image: '/images/event1.png' },
    { id: 2, name: 'Championship Final', date: '2024-06-20', price: '€45.00', image: '/images/event2.jpg' },
    { id: 3, name: 'Broadway Show', date: '2024-08-01', price: '€75.00', image: '/images/event3.jpg' }
]);
const editingEvent = ref(null);

const searchEvents = () => {
    console.log('Searching for:', searchQuery.value);
};
const editEvent = (event) => {
    editingEvent.value = {
        id: event.id,
        title: event.name,  // Убедись, что `title` есть
        date: event.date,
        price: event.price,
        image: event.image
    };
};

const cancelEdit = () => {
    editingEvent.value = null;
};
const updateEvent = () => {
    const index = featuredEvents.value.findIndex(event => event.id === editingEvent.value.id);
    if (index !== -1) {
        featuredEvents.value[index] = { ...editingEvent.value };
    }
    cancelEdit();
};

onMounted(() => {
    console.log('User:', user.value, 'Is Admin:', isAdmin.value);
});
</script>