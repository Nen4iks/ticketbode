<template>
  <form @submit.prevent="saveEvent">
      <label>Название события:</label>
      <input v-model="eventData.name" type="text" />

      <label>Дата:</label>
      <input v-model="eventData.date" type="date" />

      <label>Цена:</label>
      <input v-model="eventData.price" type="text" />

      <label>Фотография:</label>
      <input type="file" @change="handleFileUpload" />

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

const eventData = ref({
name: '',
date: '',
price: '',
image: null,
});

watch(() => props.editingEvent, (newEvent) => {
if (newEvent) {
  eventData.value = {
    ...newEvent,
    date: newEvent.date ? newEvent.date.split('T')[0] : '',
  };
}
}, { immediate: true });

const handleFileUpload = (e) => {
const file = e.target.files[0];
if (file) {
  eventData.value.image = file;
}
};

const saveEvent = () => {
emit('save', eventData.value);
};
</script>
