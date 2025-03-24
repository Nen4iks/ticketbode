<template>
    <form @submit.prevent="submit">
        <input v-model="form.name" placeholder="Название" required />
        <input v-model="form.date" type="date" required />
        <input v-model="form.price" type="number" step="0.01" placeholder="Цена" required />
        <input type="file" @change="handleFileUpload" required />
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
    image: null,
});

const handleFileUpload = (e) => {
  const file = e.target.files[0];
  if (file) {
    form.value.image = file;
  }
};

const submit = async () => {
    const formData = new FormData();
    formData.append('name', form.value.name);
    formData.append('date', form.value.date);
    formData.append('price', form.value.price);
    formData.append('image', form.value.image);

    await router.post('/events', formData, {
        onSuccess: () => {
            form.value = { name: '', date: '', price: '', image: null }; // Очистка формы
        }
    });
};
</script>
