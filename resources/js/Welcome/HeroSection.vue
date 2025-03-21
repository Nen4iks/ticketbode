<template>
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
</template>

<script setup>
import { ref, onMounted } from 'vue';

const isVisible = ref(false);
const searchQuery = ref('');

const searchEvents = () => {
    console.log('Searching for:', searchQuery.value);
};

onMounted(() => {
    setTimeout(() => {
        isVisible.value = true;
    }, 500);
});
</script>

<style scoped>
.hero {
    padding: 8rem 2rem;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.6), rgba(0, 204, 255, 0.6));
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
    background: rgba(255, 255, 255, 0.8);
    transition: all 0.3s ease;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    color: #333;
}

.search-button {
    padding: 1rem 2rem;
    background-color: #2563eb;
    color: white;
    border: none;
    border-radius: 50px;
    font-size: 1.1rem;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.search-button:hover {
    background-color: #1d4ed8;
    transform: scale(1.05);
}
</style>
