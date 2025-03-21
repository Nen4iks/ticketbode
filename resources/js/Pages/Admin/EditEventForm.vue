<template>
    <form @submit.prevent="saveEvent">
        <label>Название события:</label>
        <input v-model="eventData.name" type="text" />

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

const props = defineProps({
  editingEvent: {
    type: Object,
    default: () => null
  }
});
const emit = defineEmits(['save', 'cancel']);

// Инициализация данных для редактирования
const eventData = ref({
  name: '',
  date: '', // Ensure this is in YYYY-MM-DD format
  price: '',
  image: '',
});

// Синхронизация с редактируемым событием
watch(() => props.editingEvent, (newEvent) => {
  if (newEvent) {
    // Extract just the date part (YYYY-MM-DD)
    eventData.value = { 
      ...newEvent,
      date: newEvent.date ? newEvent.date.split('T')[0] : ''
    };
  }
}, { immediate: true });

// Сохранение данных
const saveEvent = () => {
  emit('save', eventData.value);
};
</script>