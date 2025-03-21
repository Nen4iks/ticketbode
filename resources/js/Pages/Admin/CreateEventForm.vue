<template>
    <form @submit.prevent="submit">
        <input v-model="form.name" placeholder="Название" required />
        <input v-model="form.date" type="date" required />
        <input v-model="form.price" type="number" step="0.01" placeholder="Цена" required />
        <input v-model="form.image" placeholder="URL картинки" />
        <button type="submit">Добавить</button>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const form = ref({
    name: '',
    date: '',
    price: '',
    image: ''
});

const submit = () => {
    router.post('/events', form.value, {
        onSuccess: () => {
            form.value = { name: '', date: '', price: '', image: '' }; // Очистка формы
        }
    });
};
</script>