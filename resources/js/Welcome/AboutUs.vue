<template>
    <section class="about-section">
        <div class="container">
            <h1>О нас</h1>
            <p>
                Добро пожаловать в нашу компанию! Мы стремимся предоставлять лучшие услуги и решения для наших клиентов.
            </p>

            <div class="team">
                <h2>Наша команда</h2>
                <div class="team-members">
                    <div v-for="member in team" :key="member.id" class="team-member">
                        <img :src="member.image" :alt="member.name" />
                        <h3>{{ member.name }}</h3>
                        <p>{{ member.role }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script setup>
import { ref } from 'vue';

const team = ref([
    { id: 1, name: 'Анна Иванова', role: 'CEO', image: 'https://via.placeholder.com/150' },
    { id: 2, name: 'Игорь Петров', role: 'CTO', image: 'https://via.placeholder.com/150' },
    { id: 3, name: 'Мария Смирнова', role: 'Дизайнер', image: 'https://via.placeholder.com/150' },
]);
</script>

<style scoped>
.about-section {
    padding: 2rem;
    background: #f9f9f9;
    text-align: center;
}

.container {
    max-width: 800px;
    margin: 0 auto;
}

h1, h2 {
    color: #333;
}

p {
    font-size: 1.1rem;
    color: #666;
}

.team {
    margin-top: 2rem;
}

.team-members {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
}

.team-member {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 200px;
}

.team-member img {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    object-fit: cover;
    margin-bottom: 0.5rem;
}
</style>
