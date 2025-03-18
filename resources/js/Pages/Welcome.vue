<template>
    <Head>
        <title>Welcome to Ticketbode</title>
    </Head>
    <Navbar :user="$page.props.auth.user" :canLogin="canLogin" :canRegister="canRegister" />
    <!-- Header Section -->
    <section class="hero" :class="{ 'animate': isVisible }">
        <div class="hero-content">
            <h2>Your Gateway to Live Entertainment</h2>
            <p>
                Discover and book tickets for the hottest concerts, theater shows, sports events, and more.
            </p>
            <div class="search-container">
                <input type="text" v-model="searchQuery" placeholder="Search for events..." class="search-input">
                <button @click="searchEvents" class="search-button">Search</button>
            </div>
        </div>
    </section>
    <section class="categories">
        <h3>Browse by Category</h3>
        <div class="category-grid">
            <div v-for="category in categories" :key="category.id" class="category-card" @click="filterByCategory(category.id)">
                <font-awesome-icon :icon="category.icon" />
                <h4>{{ category.name }}</h4>
            </div>
        </div>
    </section>
    <section class="featured">
        <h3>Featured Events</h3>
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
    <section class="about-us">
        <div class="about-us-content">
            <h2>Why Choose Ticketbode</h2>
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
import { ref, onMounted } from 'vue';
import { Head } from '@inertiajs/vue3';
import Navbar from '@/Components/Navbar.vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { 
    faMusic, 
    faBasketballBall, 
    faTheaterMasks, 
    faLaugh,
    faShieldAlt,
    faBolt,
    faTag,
    faHeadset 
} from '@fortawesome/free-solid-svg-icons';

library.add(
    faMusic, 
    faBasketballBall, 
    faTheaterMasks, 
    faLaugh,
    faShieldAlt,
    faBolt,
    faTag,
    faHeadset
);

const searchQuery = ref('');
const isVisible = ref(false);

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

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});

const searchEvents = () => {
    // Implement search functionality
    console.log('Searching for:', searchQuery.value);
};

const filterByCategory = (categoryId) => {
    // Implement category filtering
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
    padding: 8rem 2rem 4rem;
    background: linear-gradient(135deg, #f6f7ff 0%, #e9eeff 100%);
    text-align: center;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.6s ease-out;
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
    font-size: 2.5rem;
    color: #1a1a1a;
    margin-bottom: 1.5rem;
}

.categories {
    padding: 4rem 2rem;
    background-color: #ffffff;
}

.category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 2rem auto 0;
}

.category-card {
    background: white;
    padding: 2rem;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: transform 0.3s ease;
}

.category-card:hover {
    transform: translateY(-5px);
}

.featured {
    padding: 4rem 2rem;
    background-color: #f8fafc;
}

.event-slider {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 2rem auto 0;
}

.event-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease;
}

.event-card:hover {
    transform: translateY(-5px);
}

.event-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.event-info {
    padding: 1.5rem;
}

.event-info h4 {
    margin: 0 0 0.5rem;
    color: #1a1a1a;
}

.event-info .price {
    color: #2563eb;
    font-weight: 600;
}

.about-us {
    padding: 4rem 2rem;
    background-color: #ffffff;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 2rem auto 0;
}

.feature-card {
    text-align: center;
    padding: 2rem;
    border-radius: 12px;
    background: #f8fafc;
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
}

h3 {
    text-align: center;
    font-size: 2rem;
    color: #1a1a1a;
    margin-bottom: 2rem;
}

.search-container {
    margin-top: 2rem;
    display: flex;
    justify-content: center;
    gap: 1rem;
}

.search-input {
    padding: 1rem 1.5rem;
    border-radius: 50px;
    border: 2px solid #e5e7eb;
    width: 100%;
    max-width: 400px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.search-input:focus {
    outline: none;
    border-color: #2563eb;
}

.search-button {
    padding: 1rem 2rem;
    background-color: #2563eb;
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.search-button:hover {
    background-color: #1d4ed8;
}

@media (max-width: 768px) {
    .hero-content {
        padding: 0 1rem;
    }
    
    .search-container {
        flex-direction: column;
    }
    
    .category-grid {
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    }
}
</style>
