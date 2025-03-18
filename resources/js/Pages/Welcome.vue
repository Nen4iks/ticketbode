<template>
    <!-- Header Section -->
    <header class="header">
        <div class="header-container">
            <div class="logo-container">
                <ApplicationLogo class="logo" />
            </div>
            <nav class="nav">
                <nav v-if="canLogin" class="auth-nav">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="auth-button"
                    >
                        Dashboard
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
                <i :class="category.icon"></i>
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
                    <i :class="feature.icon"></i>
                    <h4>{{ feature.title }}</h4>
                    <p>{{ feature.description }}</p>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

const searchQuery = ref('');
const isVisible = ref(false);

const categories = ref([
    { id: 1, name: 'Concerts', icon: 'fas fa-music' },
    { id: 2, name: 'Sports', icon: 'fas fa-basketball-ball' },
    { id: 3, name: 'Theater', icon: 'fas fa-theater-masks' },
    { id: 4, name: 'Comedy', icon: 'fas fa-laugh' }
]);

const featuredEvents = ref([
    { id: 1, name: 'Summer Music Festival', date: '2024-07-15', price: '€59.99', image: '/images/event1.png' },
    { id: 2, name: 'Championship Final', date: '2024-06-20', price: '€45.00', image: '/images/event2.jpg' },
    { id: 3, name: 'Broadway Show', date: '2024-08-01', price: '€75.00', image: '/images/event3.jpg' }
]);

const features = ref([
    { id: 1, title: 'Secure Booking', icon: 'fas fa-shield-alt', description: 'Safe and encrypted transactions' },
    { id: 2, title: 'Instant Delivery', icon: 'fas fa-bolt', description: 'Get your tickets immediately' },
    { id: 3, title: 'Best Prices', icon: 'fas fa-tag', description: 'Competitive pricing guaranteed' },
    { id: 4, title: '24/7 Support', icon: 'fas fa-headset', description: 'Always here to help you' }
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

.hero {
    padding: 8rem 2rem 4rem;
    background: linear-gradient(135deg, #f6f7ff 0%, #e9eeff 100%);
    text-align: center;
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s ease;
}

.hero.animate {
    opacity: 1;
    transform: translateY(0);
}

.search-container {
    max-width: 600px;
    margin: 2rem auto;
    display: flex;
    gap: 1rem;
}

.search-input {
    flex: 1;
    padding: 1rem;
    border: none;
    border-radius: 50px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    font-size: 1rem;
}

.search-button {
    padding: 1rem 2rem;
    background-color: #2563eb;
    color: white;
    border: none;
    border-radius: 50px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.categories {
    padding: 4rem 2rem;
    background-color: white;
}

.category-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 2rem auto;
}

.category-card {
    padding: 2rem;
    background-color: #f8fafc;
    border-radius: 1rem;
    text-align: center;
    transition: transform 0.3s ease;
    cursor: pointer;
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
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 2rem auto;
}

.event-card {
    background-color: white;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
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

.about-us {
    padding: 4rem 2rem;
    background-color: white;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    max-width: 1200px;
    margin: 2rem auto;
}

.feature-card {
    padding: 2rem;
    background-color: #f8fafc;
    border-radius: 1rem;
    text-align: center;
    transition: transform 0.3s ease;
}

.feature-card:hover {
    transform: translateY(-5px);
}

h2, h3, h4 {
    color: #1e293b;
}

p {
    color: #64748b;
    line-height: 1.6;
}

@media (max-width: 768px) {
    .header-container {
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
