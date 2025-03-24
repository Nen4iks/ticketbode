<template>
    <section class="featured-events">
        <h2>Рекомендуемые события</h2>
        <div class="events-grid">
            <div v-for="event in events" :key="event.id" class="event-card">
                <!-- Формируем путь к изображению -->
                <img :src="getImagePath(event.image)" :alt="event.name" />
                <h3>{{ event.name }}</h3>
                <p><strong>Дата:</strong> {{ event.date }}</p>
                <p><strong>Цена:</strong> {{ event.price }}</p>
                <button v-if="isAdmin" @click="$emit('edit', event)">Редактировать</button>
            </div>
        </div>
    </section>
</template>

<script setup>
defineProps({
    events: Array,
    isAdmin: Boolean
});
defineEmits(['edit']);

// Метод для получения корректного пути к изображению
const getImagePath = (image) => {
    // Если путь указан, добавляем префикс /storage/, иначе возвращаем заглушку
    return image ? `/storage/${image}` : 'https://via.placeholder.com/150';
};
</script>

<style scoped>
.featured-events {
    text-align: center;
    padding: 2rem;
}

.events-grid {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.event-card {
    background: white;
    padding: 1rem;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
    width: 250px;
}

.event-card img {
    width: 100%;
    border-radius: 8px;
    height: 150px;
    object-fit: cover;
}

button {
    margin-top: 1rem;
    background: #007bff;
    color: white;
    padding: 0.5rem 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

button:hover {
    background: #0056b3;
}
</style>
