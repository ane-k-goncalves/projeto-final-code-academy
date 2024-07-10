<template>
    <div>
      <h1>Favorite Foods</h1>
      <draggable v-model="meals" tag="ul" group="meals" :animation="300">
        <template #item="{ element: meal }">
          <li>{{ meal }}</li>
        </template>
      </draggable>
  
      <h1>Terrible Foods</h1>
      <draggable v-model="yuckyMeals" tag="ul" group="meals" :animation="300">
        <template #item="{ element: meal }">
          <li>{{ meal }}</li>
        </template>
      </draggable>
    </div>
  </template>
  
  <script setup>
  import { ref } from 'vue';
  import draggable from 'vuedraggable';
  
  const meals = ref([
    'Pizza',
    'Sushi',
    'Pasta'
  ]);
  
  const yuckyMeals = ref([
    'Bat wing soup',
    'Spicy Octopus',
    'Anything from Taco Bell',
  ]);
  </script>
  
  <style scoped>
  /* Adicione estilos específicos para o componente Teste aqui, se necessário */
  </style>
  