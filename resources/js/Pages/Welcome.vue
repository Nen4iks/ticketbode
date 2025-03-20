<template>
    <Head>
        <title>Welcome to Ticketbode</title>
    </Head>

    <!-- Навигация -->
    <Navbar :user="user" :canLogin="canLogin" :canRegister="canRegister" />

    <!-- Главный экран -->
    <section class="hero" :class="{ 'animate': isVisible }">
        <div class="hero-content">
            <h2>Your Gateway to Live Entertainment</h2>
            <p>Discover and book tickets for the hottest concerts, theater shows, sports events, and more.</p>
            <div class="search-container">
                <input type="text" v-model="searchQuery" placeholder="Search for events..." class="search-input">
                <button @click="searchEvents" class="search-button">Search</button>
            </div>
        </div>
    </section>

    <!-- Категории -->
    <section class="categories">
        <h3 class="section-heading">Browse by Category</h3>
        <div class="category-grid">
            <div v-for="category in categories" :key="category.id" class="category-card" @click="filterByCategory(category.id)">
                <font-awesome-icon :icon="category.icon" />
                <h4>{{ category.name }}</h4>
            </div>
        </div>
    </section>

    <!-- Избранные события -->
    <section class="featured">
        <h3 class="section-heading">Featured Events</h3>
        <div class="event-slider">
            <div v-for="event in featuredEvents" :key="event.id" class="event-card">
                <img :src="event.image" :alt="event.name">
                <div class="event-info">
                    <h4>{{ event.name }}</h4>
                    <p>{{ event.date }}</p>
                    <span class="price">{{ event.price }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- О нас -->
    <section class="about-us">
        <div class="about-us-content">
            <h2 class="section-heading">Why Choose Ticketbode</h2>
            <div class="features-grid">
                <div v-for="feature in features" :key="feature.id" class="feature-card">
                    <font-awesome-icon :icon="feature.icon" />
                    <h4>{{ feature.title }}</h4>
                    <p>{{ feature.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faMusic, faBasketballBall, faTheaterMasks, faLaugh, faShieldAlt, faBolt, faTag, faHeadset } from '@fortawesome/free-solid-svg-icons';

// Добавляем иконки в библиотеку
library.add(faMusic, faBasketballBall, faTheaterMasks, faLaugh, faShieldAlt, faBolt, faTag, faHeadset);

const searchQuery = ref('');
const isVisible = ref(false);

// Данные из Inertia.js (заменяет $page.props)
const page = usePage();
const user = computed(() => page.props.auth?.user || null);
const canLogin = computed(() => page.props.canLogin ?? true);
const canRegister = computed(() => page.props.canRegister ?? true);

const categories = ref([
    { id: 1, name: 'Concerts', icon: ['fas', 'music'] },
    { id: 2, name: 'Sports', icon: ['fas', 'basketball-ball'] },
    { id: 3, name: 'Theater', icon: ['fas', 'theater-masks'] },
    { id: 4, name: 'Comedy', icon: ['fas', 'laugh'] }
]);

const featuredEvents = ref([
    { id: 1, name: 'Summer Music Festival', date: '2024-07-15', price: '€59.99', image: '/images/event1.png' },
    { id: 2, name: 'Championship Final', date: '2024-06-20', price: '€45.00', image: '/images/event2.jpg' },
    { id: 3, name: 'Broadway Show', date: '2024-08-01', price: '€75.00', image: '/images/event3.jpg' }
]);

const features = ref([
    { id: 1, title: 'Secure Booking', icon: ['fas', 'shield-alt'], description: 'Safe and encrypted transactions' },
    { id: 2, title: 'Instant Delivery', icon: ['fas', 'bolt'], description: 'Get your tickets immediately' },
    { id: 3, title: 'Best Prices', icon: ['fas', 'tag'], description: 'Competitive pricing guaranteed' },
    { id: 4, title: '24/7 Support', icon: ['fas', 'headset'], description: 'Always here to help you' }
]);

const searchEvents = () => {
    console.log('Searching for:', searchQuery.value);
};

const filterByCategory = (categoryId) => {
    console.log('Filtering by category:', categoryId);
};

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
    }, 500);
});
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

* {
    font-family: 'Poppins', sans-serif;
}

.hero {
    padding: 8rem 2rem;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.6), rgba(0, 204, 255, 0.6));
    background-size: cover;
    background-position: center;
    text-align: center;
    color: white;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.6s ease-out;
    border-radius: 10px;
}

.hero.animate {
    opacity: 1;
    transform: translateY(0);
}

.hero-content {
    max-width: 800px;
    margin: 0 auto;
}

.hero h2 {
    font-size: 3rem;
    font-weight: 600;
    margin-bottom: 1rem;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.4);
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    line-height: 1.5;
    text-shadow: 1px 1px 6px rgba(0, 0, 0, 0.4);
}

.search-container {
    display: flex;
    justify-content: center;
    gap: 1rem;
    margin-top: 2rem;
}

.search-input {
    padding: 1rem 2rem;
    border-radius: 50px;
    border: none;
    font-size: 1rem;
    width: 300px;
    max-width: 400px;
    background: rgba(255, 255, 255, 0.8);
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    color: #333; /* Цвет текста */
}

.search-input:focus {
    outline: none;
    background: white;
    box-shadow: 0 4px 15px rgba(0, 0, 255, 0.3);
    transform: scale(1.05);
}

.search-button {
    padding: 1rem 2rem;
    background-color: #2563eb;
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
    font-size: 1.1rem;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}

.search-button:hover {
    background-color: #1d4ed8;
    transform: scale(1.05);
}

@media (max-width: 768px) {
    .hero h2 {
        font-size: 2rem;
    }

    .hero p {
        font-size: 1rem;
    }

    .search-container {
        flex-direction: column;
    }

    .search-input {
        width: 100%;
    }
}

.categories, .featured, .about-us {
    padding: 4rem 2rem;
    background-color: #f9fafb;
}

.category-grid, .event-slider, .features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 2rem auto 0;
}

.category-card, .event-card, .feature-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.category-card:hover, .event-card:hover, .feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
}

.category-card {
    background: #f5f7fa;
    border: 2px solid #e0e0e0;
    color: #333;
}

.category-card h4 {
    font-weight: 600;
    color: #2563eb;
    margin-top: 1rem;
}

.event-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 8px;
}

.event-info {
    padding: 1.5rem;
}

.event-info h4 {
    margin: 0 0 0.5rem;
    color: #1a1a1a;
}

.event-info p {
    color: #777;
    font-size: 0.95rem;
}

.event-info .price {
    color: #2563eb;
    font-weight: 600;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.feature-card {
    background: white;
    padding: 1.5rem;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
}

.feature-card h4 {
    font-weight: 600;
    margin-top: 1rem;
}

.feature-card p {
    color: #555;
}

.about-us h2 {
    font-size: 2rem;
    font-weight: 600;
    margin-bottom: 2rem;
    text-align: center;
    color: #1a1a1a;
}

/* Добавлены стили для заголовков категорий и избранных событий */
.section-heading {
    font-size: 2rem;
    font-weight: 600;
    color: #1a1a1a;
    text-align: center;
    margin-bottom: 2rem;
}

@media (max-width: 768px) {
    .categories, .featured, .about-us {
        padding: 2rem 1rem;
    }
}
</style>
