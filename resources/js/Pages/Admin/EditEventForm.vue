<template>
    <form @submit.prevent="saveEvent">
        <label>Название события:</label>
        <input v-model="eventData.title" type="text" />

        <label>Дата:</label>
        <input v-model="eventData.date" type="date" />

        <label>Цена:</label>
        <input v-model="eventData.price" type="text" />

        <button type="submit">Сохранить</button>
        <button type="button" @click="$emit('cancel')">Отмена</button>
    </form>
</template>

<script setup>
import { ref, watch } from 'vue';

const props = defineProps(['editingEvent']);
const emit = defineEmits(['save', 'cancel']);

const eventData = ref({
    title: '',
    date: '',
    price: '',
    image: '',
});

watch(() => props.editingEvent, (newEvent) => {
    if (newEvent) {
        eventData.value = { ...newEvent };
    }
}, { immediate: true });

const saveEvent = () => {
    emit('save', eventData.value);
};
</script>